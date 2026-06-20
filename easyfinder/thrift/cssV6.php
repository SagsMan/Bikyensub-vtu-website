    <!-- Favicons -->
    <link rel="shortcut icon" href="theme/images/<?php echo APP_ICON;?>" />
    <link rel="apple-touch-icon" href="theme/images/<?php echo APP_ICON;?>" sizes="180x180">
    <link rel="icon" href="theme/images/<?php echo APP_ICON;?>" sizes="32x32" type="image/png">
    <link rel="icon" href="theme/images/<?php echo APP_ICON;?>" sizes="16x16" type="image/png">
    <link rel="manifest" href="">
    <link rel="mask-icon" href="theme/images/<?php echo APP_ICON;?>" color="#712cf9">
    <link rel="icon" href="theme/images/<?php echo APP_ICON;?>">
    <meta name="theme-color" content="#712cf9">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="theme/vendors/bootstrap5/bootstrap.min.css">
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"-->
    <!-- Bootstrap JS -->
    <script src="theme/vendors/bootstrap5/bootstrap.bundle.min.js"></script>
    <!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script-->

    <link rel="stylesheet" href="external-custom.css">

    <link rel="stylesheet" href="theme/vendors/animatecss/animate.min.css">

    <link href="theme/vendors/summernote/summernote.min.css" rel="stylesheet">

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