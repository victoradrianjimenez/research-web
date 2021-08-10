@php
  function getSocialIconClass($name){
    switch($name){
      case 'scholar': return 'ri-google-fill';
      case 'calendly': return 'ri-calendar-fill';
      case 'bitbucket': return 'ri-git-branch-fill';
      case 'linkedin': return 'ri-linkedin-box-fill';
      case '':
      case 'website':
      case 'researchgate':
      case 'orcid':
      case 'publons':
      case 'zotero':
      case 'mendeley':
        return 'ri-earth-fill';
      default:
        return 'ri-'.$name.'-fill';
    }
  }
@endphp