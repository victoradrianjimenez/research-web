<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AudioLabs\BibtexParser\BibtexParser;

class Publication extends Model{
    use HasFactory;

    protected $fillable = [
        'bibtex',
    ];

    public function members(){
        return $this->belongsToMany(Member::class, 'publication_member');
    }

    public function parse(){
        $entry = $this->parse_string($this->bibtex);
        if (is_array($entry)){
            $this->year = (isset($entry['year'])) ? (int) $entry['year'] : 0;
            $this->citation = self::format($entry);
            $this->url = strtolower($entry['reference']);
            $this->type = strtolower($entry['type']);
            return true;
        }
        return false;
    }

    public static function parse_string($bibtex){
        try{
            $entries = BibtexParser::parse_string($bibtex);
        }catch (\Exception $e){
            return false;
        }
        if (count($entries) == 1){
            $entry = $entries[0];
            return $entry;
        }
        return false;
    }

    private static function format($entry){
        $format = [
        "article" => "{author},  <strong>{title}</strong>, {journal}[, {volume}][({number})][: {pages}], {year}. [, {dbslinks}]",
        "book" => "{author},  <strong>{title}</strong>, {publisher}[, ISBN: {isbn}], {year}. [, {dbslinks}]",
        "inbook" => "{author},  <strong>{title}</strong>, {publisher}[, ISBN: {isbn}], {year}. [, {dbslinks}]",
        "incollection" => "{author},  <strong>{title}</strong>, In[ {editor} (ed.)]: {booktitle}, {publisher}[, {volume}][: {pages}], {year}. [, {dbslinks}]",
        "proceedings" => "[{author},  ]<strong>{title}</strong>, [In {booktitle}, ]{year}. [, {dbslinks}]",
        "inproceedings" => "{author},  <strong>{title}</strong>, In {booktitle}, {year}. [, {dbslinks}]",
        "mastersthesis" => "{author},  <strong>{title}</strong>, [{note},] {school}, {year}. [, {dbslinks}]",
        "misc" => "[{author}, ][ <strong>{title}</strong>, ][{howpublished}, ][{note}][, {year}]. [, {dbslinks}]",
        "phdthesis" => "{author},  <strong>{title}</strong>, PhD Thesis, {school}, {year}. [, {dbslinks}]",
        "techreport" => "{author},  <strong>{title}</strong>, Technical Report, [No. {number}, ]{institution}, {year}. [, {dbslinks}]",
        "unpublished" => "{author},  <strong>{title}</strong>, {note}. [, {dbslinks}]",
        "patent" => "{author},  <strong>{title}</strong>, {assignee}, Nro. {number}, {nationality}, {year} [, {dbslinks}]",
        "default" => "{author},  <strong>{title}</strong>, {journal}{booktitle}, {year} [, {dbslinks}]"
        ];
        $type = strtolower($entry['type']);
        $body = $format[(isset($format[$type]))?$type:'default'];
        preg_match_all("/{(\w+)}/", $body, $placeholder);
        for ($j = 0; $j < count($placeholder[0]); $j++) {
            $key = strtolower($placeholder[1][$j]);
            // Check if field is actually set
            if (!empty($entry[$key])) {
                // Arrays need special treatment
                if(is_array($entry[$key])) {
                    if($key == 'author') {
                        $data = implode(' and ', $entry[$key]);
                    }
                    elseif($key == 'pages' && is_array($entry[$key])) {
                        $data = $entry[$key]['start'] . '&mdash;' . $entry[$key]['end'];
                    }
                    else {
                        $data = "";
                    }
                }
                // Regular strings are simply used as-is
                else {
                    $data = $entry[$key];
                }
                $body = str_ireplace($placeholder[0][$j], $data, $body);
            }
        }
        return \AudioLabs\BibtexParser\BibtexFormatter::removeOptionalFields($body);
    }
}
