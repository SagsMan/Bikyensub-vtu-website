<!-- plugins:css -->
<link rel="stylesheet" href="theme/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="theme/vendors/base/vendor.bundle.base.css">
<!-- endinject -->
<!-- plugin css for this page -->
<link rel="stylesheet" href="theme/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<!-- End plugin css for this page -->
<!-- inject:css -->
<link rel="stylesheet" href="theme/css/style.css">
<!-- endinject -->

<!-- inject:css -->
<link rel="stylesheet" href="theme/custom/custom.css">

<link rel="stylesheet" href="external-custom.css?ver=100">

<!-- endinject -->
<link rel="shortcut icon" href="theme/images/<?php echo APP_ICON;?>" />

<!--link rel="stylesheet" href="theme/vendors/introjs/introjs.min.css"-->

<link rel="stylesheet" href="theme/vendors/animatecss/animate.min.css">

<link href="theme/vendors/summernote/summernote.min.css" rel="stylesheet">



<script src="theme/vendors/base/vendor.bundle.base.js"></script>

<script src="theme/vendors/ace.js/ace.js"></script>


<script>
function encode_algocode(content, contentType) {

    if (content == '' || contentType == '') {
        return content;
    }

    switch (contentType) {
        case 'json':
        case 'object':
        case 'array':
            content = content.replace(/"/g, '$dblquote$');
            content = content.replace(/"/g, '$doublequote$');
            content = content.replace(/\'/g, '$singlequote$');
            content = content.replace(/,/g, '$comma$');
            content = content.replace(/:/g, '$fullcolon$');
            content = content.replace(/{/g, '$lbrace$');
            content = content.replace(/}/g, '$rbrace$');
            content = content.replace(/\./g, '$fullstop$');
            content = content.replace(/\*/g, '$asterisk$');
            content = content.replace(/\//g, '$fslash$');
            content = content.replace(/\\/g, '$bslash$');
            break;
        case 'php':
            content = content.replace(/</g, '$gt$');
            content = content.replace(/>/g, '$lt$');
            content = content.replace(/&/g, '$amp$');
            content = content.replace(/\//g, '$fslash$');
            content = content.replace(/\\/g, '$bslash$');
            content = content.replace(/;/g, '$semicolon$');
            content = content.replace(/"/g, '$dblquote$');
            content = content.replace(/"/g, '$doublequote$');
            content = content.replace(/\'/g, '$singlequote$');
            content = content.replace(/,/g, '$comma$');
            content = content.replace(/ /g, '$space$');
            content = content.replace(/\./g, '$fullstop$');
            content = content.replace(/\*/g, '$asterisk$');
            break;
        case 'sql':
            content = content.replace(/,/g, '$comma$');
            content = content.replace(/\./g, '$fullstop$');
            content = content.replace(/\*/g, '$asterisk$');
            content = content.replace(/\//g, '$fslash$');
            content = content.replace(/\\/g, '$bslash$');
            break;
        case 'text':
            content = content;
            break;
        case 'mixed':
        case 'html':
            content = content.replace(/"/g, '$dblquote$');
            content = content.replace(/"/g, '$doublequote$');
            content = content.replace(/'/g, '$singlequote$');
            content = content.replace(/,/g, '$comma$');
            content = content.replace(/:/g, '$fullcolon$');
            content = content.replace(/;/g, '$semicolon$');
            content = content.replace(/{/g, '$lbrace$');
            content = content.replace(/}/g, '$rbrace$');
            content = content.replace(/</g, '$gt$');
            content = content.replace(/>/g, '$lt$');
            content = content.replace(/&/g, '$amp$');
            content = content.replace(/\//g, '$fslash$');
            content = content.replace(/\\/g, '$bslash$');
            content = content.replace(/ /g, '$space$');
            content = content.replace(/\./g, '$fullstop$');
            content = content.replace(/\*/g, '$asterisk$');

            break;
        default:
            break;
    }

    return content;
}

function decode_algocode(content, contentType) {

    if (content == '' || contentType == '') {
        return content;
    }

    switch (contentType) {
        case 'json':
        case 'object':
        case 'array':
            content = content.replace(/\$dblquote\$/g, '"');
            content = content.replace(/\$doublequote\$/g, '"');
            content = content.replace(/\$singlequote\$/g, '\'');
            content = content.replace(/\$comma\$/g, ',');
            content = content.replace(/\$fullcolon\$/g, ':');
            content = content.replace(/\$lbrace\$/g, '{');
            content = content.replace(/\$rbrace\$/g, '}');
            content = content.replace(/\$fullstop\$/g, '\.');
            content = content.replace(/\$asterisk\$/g, '\*');
            content = content.replace(/\$fslash\$/g, '/');
            content = content.replace(/\$bslash\$/g, '\\');
            break;
        case 'php':
            content = content.replace(/\$gt\$/g, '<');
            content = content.replace(/\$lt\$/g, '>');
            content = content.replace(/\$amp\$/g, '&');
            content = content.replace(/\$fslash\$/g, '/');
            content = content.replace(/\$bslash\$/g, '\\');
            content = content.replace(/\$semicolon\$/g, ';');
            content = content.replace(/\$dblquote\$/g, '"');
            content = content.replace(/\$doublequote\$/g, '"');
            content = content.replace(/\$singlequote\$/g, '\'');
            content = content.replace(/\$comma\$/g, ',');
            content = content.replace(/\$space\$/g, ' ');
            content = content.replace(/\$fullstop\$/g, '\.');
            content = content.replace(/\$asterisk\$/g, '\*');
            break;
        case 'sql':
            content = content.replace(/\$comma\$/g, ',');
            content = content.replace(/\$fullstop\$/g, '\.');
            content = content.replace(/\$asterisk\$/g, '\*');
            content = content.replace(/\$fslash\$/g, '/');
            content = content.replace(/\$bslash\$/g, '\\');
            content = content.replace(/\$doublequote\$/g, '"');
            break;
        case 'text':
            content = content;
            break;
        case 'mixed':
        case 'html':
            content = content.replace(/\$dblquote\$/g, '"');
            content = content.replace(/\$doublequote\$/g, '"');
            content = content.replace(/\$singlequote\$/g, '\'');
            content = content.replace(/\$comma\$/g, ',');
            content = content.replace(/\$fullcolon\$/g, ':');
            content = content.replace(/\$semicolon\$/g, ';');
            content = content.replace(/\$lbrace\$/g, '{');
            content = content.replace(/\$rbrace\$/g, '}');
            content = content.replace(/\$gt\$/g, '<');
            content = content.replace(/\$lt\$/g, '>');
            content = content.replace(/\$amp\$/g, '&');
            content = content.replace(/\$fslash\$/g, '/');
            content = content.replace(/\$bslash\$/g, '\\');
            content = content.replace(/\$space\$/g, ' ');
            content = content.replace(/\$fullstop\$/g, '\.');
            content = content.replace(/\$asterisk\$/g, '\*');


            break;
        default:
            break;
    }

    return content;
}
</script>

<style type="text/css">
              .table-container thead {
                position: sticky;
                top: 0;
                background-color: #fff; /* Adjust as needed */
                z-index: 1;
              }
            </style>