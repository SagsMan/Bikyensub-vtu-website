<?php 
/***************
 * FUNCTION IN THIS FILE WILL BE STRICTLY RELATED TO CUSTOM ALGOCODE FIELDS.
 * CUSTOM FIELDS ARE FIELDS THAT ARE HIDDEN AND VISUALLY/PROCESSED USING PHP/JS AND OUTPUT STORED IN THE HIDDEN FIELDS
 * FOR SUBMISSION TO DATABASE
 */

/************************************************************************************************************************************
 * TEXTTABLE START
 */
{
  /********texttable control start***********/
  function formatdisplay_tablestringchoices($field_arr, $symbolAssign, $symbolDelimiter)
  {
      $result = '';
      for ($i = 0; $i < count($field_arr) - 1; $i++) {
          if ((isset($field_arr[$i]['status'])) || (empty($field_arr[$i]['fieldname']) || empty($field_arr[$i]['fieldtype']))) {
          } else {

              //if len then concat to type
              if (!empty($field_arr[$i]['fieldlength'])) {
                  if ($field_arr[$i]['fieldlength'] > 0 && ($field_arr[$i]['fieldtype'] == 'string' || $field_arr[$i]['fieldtype'] == 'stringchoices')) {
                      $field_arr[$i]['fieldtype'] .= ';' . $field_arr[$i]['fieldlength'];
                  }
              }

              $result .= $field_arr[$i]['fieldname'] . $symbolAssign . $field_arr[$i]['fieldtype'];
              if (($i + 1 < count($field_arr) - 1) && (!empty($field_arr[$i + 1]['fieldname']) && !empty($field_arr[$i + 1]['fieldtype']))) {
                  $result .= $symbolDelimiter;
              } else {
              }
          }
      }
      return $result;
  }

  function formatsave_tablestringchoices($fieldvalue, $symbolAssign, $symbolDelimiter)
  {
      return str_replace('$as$', $symbolAssign, str_replace('$comma$', $symbolDelimiter, $fieldvalue));
  }

  function get_tablestringchoices($fieldname, $fieldvalue, $maxrows = 120)
  {
      /*
      Field Type: tablestringchoices
      Format: a $as$ int $comma$ b $as$ text
      */
      $output = '';
      /*convert field contents to array*/
      $fieldvalue_arr = array();
      if (!empty($fieldvalue)) {
          /*start derive array*/
          $xatcomma = explode(',', $fieldvalue);
          for ($i = 0; $i < count($xatcomma); $i++) {
              $xatas = explode(' as ', $xatcomma[$i]);
              if (count($xatas) == 2) {
                  $row["fieldname"] = trim($xatas[0]);
                  $row["fieldtype"] = trim($xatas[1]);
                  $row["fieldlength"] = '';
                  //get len
                  $lenn = explode(";", trim($xatas[1]));
                  if (isset($lenn[1])) {
                      if ($lenn[1] > 0) {
                          $row["fieldlength"] = $lenn[1];
                          $row["fieldtype"] = $lenn[0];
                      }
                  }

                  $fieldvalue_arr[] = $row;
              }
          }
      }

      $maxrows = $maxrows - count($fieldvalue_arr);
      for ($i = 0; $i < $maxrows; $i++) {
          $row['fieldname'] = '';
          $row['fieldtype'] = '';
          $row["fieldlength"] = '';
          $fieldvalue_arr[] = $row;
      }

      /*generate table*/
      $output .= '<table class="table table-sm table-responsivex">';
      /*$output .= '<thead class="p-0 m-0">
      <tr class="p-0 m-0"><th style="padding: unset !important;" class="p-0 m-0">Name</th><th style="padding: unset !important;" class="p-0 m-0">Type</th><th style="padding: unset !important;" class="p-0 m-0">Delete</th></tr>
      <thead>';*/
      $output .= '<tr class="p-0 m-0 font-weight-bold"><td class="p-1 m-0">Name</td><td class="p-0 m-0">Type</td><td class="p-0 m-0">Length</td><td class="p-0 m-0">Delete</td></tr>';
      $output .= '<tbody>';

      for ($i = 0; $i < count($fieldvalue_arr); $i++) {
          $output .= '<tr class="p-0 m-0">';
          $output .= '<td class="p-0 m-0 pr-1"><input class="form-control form-control-sm" name="' . $fieldname . "[$i][fieldname]" . '" type="text" value="' . $fieldvalue_arr[$i]["fieldname"] . '" /></td>';
          $output .= '
        <td class="p-0 m-0">
          <select class="form-control form-control-sm" name="' . $fieldname . "[$i][fieldtype]" . '" >
            <option selected value="' . $fieldvalue_arr[$i]["fieldtype"] . '">' . $fieldvalue_arr[$i]["fieldtype"] . '</option>
            <option value="string">string</option>
            <option value="text">text</option>
                      <option value="number">number</option>
                      <option value="decimal">decimal</option>
                      <option value="currency">currency</option>
                      <option value="money">money</option>
            <option value="checkbox">checkbox</option>
            <option value="date">date</option>
                      <option value="file">file</option>
                      <option value="multiplefiles">multiplefiles</option>
                      <option value="multiplefilesimage">multiplefilesimage</option>
                      <option value="multiplefilesdocument">multiplefilesdocument</option>
                      <option value="multiplefilesaudio">multiplefilesaudio</option>
                      <option value="filedocument">filedocument</option>
                      <option value="jsonform">jsonform</option>
            <option value="grid">grid</option>
            <option value="texttable">texttable</option>
            <option value="codeeditor">codeeditor</option>
                      <option value="texteditor">texteditor</option>
                      <option value="fieldeditor">fieldeditor</option>
          </select>
        </td>';
          $output .= '<td class="p-0 m-0 pr-1"><input class="form-control form-control-sm" name="' . $fieldname . "[$i][fieldlength]" . '" type="number" value="' . $fieldvalue_arr[$i]["fieldlength"] . '" /></td>';
          $output .= '<td class="p-0 m-0"><div class="form-check form-check-danger"><label class="form-check-label"><input class="form-control form-control-sm form-check-input" name="' . $fieldname . "[$i][status]" . '" type="checkbox"  /></label><div></td>';
          $output .= '</tr>';
      }
      $output .= '</tbody></table>';
      return $output;
  }

  /********texttable control end*******************/
}

/************************************************************************************************************************************
 * GRID START
 */
{
  /***********grid control****************** */
  function get_grid($fieldname, $fieldvalue, $json_)
  {

      //NOTE: becaose : is used for something in a json :=; and ,=/, so change them back
      $json_ = str_replace(';', ':', $json_);
      $json_ = str_replace('/', ',', $json_);
      $json_ = str_replace('$space$', ' ', $json_);
      $json_ = str_replace("'", '"', $json_);
      //echo $json_;

      /*if fieldvalue empty create blank*/
      if (empty($fieldvalue) || $fieldvalue == '""') {
          $fieldvalue = "[]";
          //$fieldvalue = '[["",""]]';
      }

      /*format: $json_[0]['col'];*/
      $cols = json_decode($json_, true);
      $rows = json_decode($fieldvalue, true);
      /*
      echo '<pre>';
      print_r ( $json_ );
      echo '</pre>';
      */

      /*table container*/
      $output = '';
      $maxrows = 0;

      if (isset($cols)) {
          $maxrows = $cols[count($cols) - 1]['numrows'];
      }

      /*convert field contents to array*/
      if (isset($rows)) {
          $maxrows = $maxrows - count($rows);
      }
      $row = array();
      for ($ic = 0; $ic < count($cols) - 1; $ic++) {
          $row[] = '';
      }
      for ($i = 0; $i < $maxrows; $i++) {
          $rows[] = $row;
      }

      //print_r($rows);exit();

      /*generate table*/
      $output .= '<table class="table table-sm table-bordered table-striped">';

      //header
      $output .= '<thead>';
      $output .= '<tr>';
      //cols
      for ($ic = 0; $ic < count($cols) - 1; $ic++) {
          $output .= '<th>' . $cols[$ic]['col'] . '</th>';
      }
      $output .= '</tr>';
      //}
      $output .= '</thead>';
      //header

      //rows
      $output .= '<tbody>';
      //rows
      for ($ir = 0; $ir < count($rows); $ir++) {
          $output .= '<tr class="p-0 m-0">';
          //cols
          /*for ($ic=0; $ic < count($rows[$ir]) ; $ic++) {
          $output .='<td class="p-0 m-0 pr-1">
          <input class="form-control form-control-sm"
          name="'.$fieldname."[$ir][$ic]".'"
          type="text"
          value="'.$rows[$ir][$ic].'" />
          </td>';
          }*/
          for ($ic = 0; $ic < count($rows[$ir]); $ic++) {

              /*                    if($ic==1){
              $output .='<td class="p-0 m-0 pr-1" style="width:65px !important;">';}
              else{
              $output .='<td class="p-0 m-0 pr-1">';
              }*/

              if (!empty($cols[$ic]['width'])) {
                  $output .= '<td class="p-0 m-0 pr-1" style="width:' . $cols[$ic]['width'] . ' !important;">';
              } else {
                  $output .= '<td class="p-0 m-0 pr-1">';
              }

              if ($cols[$ic]['type'] == 'label') {

                  $label = str_replace('*br', '<br>', $rows[$ir][$ic]);
                  $label = str_replace('*small', '<small class="text-danger font-weight-bold">', $label);
                  $label = str_replace('small*', '</small>', $label);

                  $output .= '
              <input
              name="' . $fieldname . "[$ir][$ic]" . '"
              type="hidden"
              value="' . $rows[$ir][$ic] . '" />
              ' . $label . '
              ';
              } else {

                  $output .= '
              <input class="form-control form-control-sm"
              name="' . $fieldname . "[$ir][$ic]" . '"
              type="' . $cols[$ic]['type'] . '"
              value="' . $rows[$ir][$ic] . '" />';
              }

              $output .= '</td>';
          }

          $output .= '</tr>';
      }
      $output .= '</tbody></table>';
      //rows

      return $output;
  }
  /***********grid control****************** */
}

/************************************************************************************************************************************
 * FIELD EDITOR START
 */
{
  /*********fieldeditor control satrt */

  function get_fieldeditor($fieldname, $fieldvalue)
  {
      $maxrows=0;
      return '<h1 class="display-4">'.$fieldvalue.'</h1>';
      /*
      Field Type: tablestringchoices
      Format: a $as$ int $comma$ b $as$ text
      */
      $output = '';
      /*convert field contents to array*/
      $fieldvalue_arr = array();
      if (!empty($fieldvalue)) {
          /*start derive array*/
          $xatcomma = explode(',', $fieldvalue);
          for ($i = 0; $i < count($xatcomma); $i++) {
              $xatas = explode(' as ', $xatcomma[$i]);
              if (count($xatas) == 2) {
                  $row["fieldname"] = trim($xatas[0]);
                  $row["fieldtype"] = trim($xatas[1]);
                  $row["fieldlength"] = '';
                  //get len
                  $lenn = explode(";", trim($xatas[1]));
                  if (isset($lenn[1])) {
                      if ($lenn[1] > 0) {
                          $row["fieldlength"] = $lenn[1];
                          $row["fieldtype"] = $lenn[0];
                      }
                  }

                  $fieldvalue_arr[] = $row;
              }
          }
      }

      $maxrows = $maxrows - count($fieldvalue_arr);
      for ($i = 0; $i < $maxrows; $i++) {
          $row['fieldname'] = '';
          $row['fieldtype'] = '';
          $row["fieldlength"] = '';
          $fieldvalue_arr[] = $row;
      }

      /*generate table*/
      $output .= '<table class="table table-sm table-responsivex">';
      /*$output .= '<thead class="p-0 m-0">
      <tr class="p-0 m-0"><th style="padding: unset !important;" class="p-0 m-0">Name</th><th style="padding: unset !important;" class="p-0 m-0">Type</th><th style="padding: unset !important;" class="p-0 m-0">Delete</th></tr>
      <thead>';*/
      $output .= '<tr class="p-0 m-0 font-weight-bold"><td class="p-1 m-0">Name</td><td class="p-0 m-0">Type</td><td class="p-0 m-0">Length</td><td class="p-0 m-0">Delete</td></tr>';
      $output .= '<tbody>';

      for ($i = 0; $i < count($fieldvalue_arr); $i++) {
          $output .= '<tr class="p-0 m-0">';
          $output .= '<td class="p-0 m-0 pr-1"><input class="form-control form-control-sm" name="' . $fieldname . "[$i][fieldname]" . '" type="text" value="' . $fieldvalue_arr[$i]["fieldname"] . '" /></td>';
          $output .= '
        <td class="p-0 m-0">
          <select class="form-control form-control-sm" name="' . $fieldname . "[$i][fieldtype]" . '" >
            <option selected value="' . $fieldvalue_arr[$i]["fieldtype"] . '">' . $fieldvalue_arr[$i]["fieldtype"] . '</option>
            <option value="string">string</option>
            <option value="text">text</option>
                      <option value="number">number</option>
                      <option value="decimal">decimal</option>
                      <option value="currency">currency</option>
                      <option value="money">money</option>
            <option value="checkbox">checkbox</option>
            <option value="date">date</option>
                      <option value="file">file</option>
                      <option value="multiplefiles">multiplefiles</option>
                      <option value="multiplefilesimage">multiplefilesimage</option>
                      <option value="multiplefilesdocument">multiplefilesdocument</option>
                      <option value="multiplefilesaudio">multiplefilesaudio</option>
                      <option value="filedocument">filedocument</option>
                      <option value="jsonform">jsonform</option>
            <option value="grid">grid</option>
            <option value="texttable">texttable</option>
            <option value="codeeditor">codeeditor</option>
                      <option value="texteditor">texteditor</option>
                      <option value="fieldeditor">fieldeditor</option>
          </select>
        </td>';
          $output .= '<td class="p-0 m-0 pr-1"><input class="form-control form-control-sm" name="' . $fieldname . "[$i][fieldlength]" . '" type="number" value="' . $fieldvalue_arr[$i]["fieldlength"] . '" /></td>';
          $output .= '<td class="p-0 m-0"><div class="form-check form-check-danger"><label class="form-check-label"><input class="form-control form-control-sm form-check-input" name="' . $fieldname . "[$i][status]" . '" type="checkbox"  /></label><div></td>';
          $output .= '</tr>';
      }
      $output .= '</tbody></table>';
      return $output;
  }

  /**********fieldeditor control end */


  /*algocodefieldeditor*/
  function get_algocodefieldeditor($fieldname,$fieldid, $fieldvalue){
      echo 'CAUSE ERROR NOT IN USE?????????????get_algocodefieldeditor??????????????????????';
      $editor ='';
      $editor =' <div class="mb-1x col-12x col-md-3x stretch-cardx mr-0x" style="font-sizex: .1rem !important;heightx: 36rem  !important">
      <div class="cardx mt-0x p-0x mr-0x" style="overflow: autox !important;">
        <div class="card-body p-0 pt-2 pl-2 p-3 mt-0 mr-0">
          <p class="card-title mb-0" style="font-size: .7rem !important;" id="selectedpagecomponentfieldlabel">Fields</p>

          <!-- Select -->
          <div class="col-12 mb-2 p-0 pr-2">
            <div class="form-group m-1">
              <div class="input-group" style="">
                <!--span class="input-group-text bg-primary text-white font-weight-bold">Fields</span-->
                <select id="listOffields" onchange="getSelectedField();" class="form-control form-control-sm" placeholder="Fields" aria-label="Fields" style="-webkit-box-shadow: none !important;">
                </select>
                <!--div class="input-group-append">
                  <button style="height: 1.7rem;padding-top: .3rem" onclick="getSelectedField();" class="btn btn-sm btn-primary" type="button">Edit</button>
                </div-->
              </div>
            </div>
          </div>

          <!-- Form -->
          <small>
          <div class="col-12 mb-2 p-0 pr-2">
            <form class="forms-sample">
              <input type="hidden" name="id" id="id" >
              <input type="hidden" name="filter_on" id="filter_on" value="">
              <!--input type="hidden" name="filter_on_value_from" id="filter_on_value_from" -->

              <p class="card-title mb-0" style="font-size: .7rem !important;" >Properties</p>
            <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group mb-2">
                <label for="fullname" style="font-size: .8rem !important">Fullname</label>
                <input readonly type="text"  style="font-size: .8rem !important;height: 1.6rem;font-weight: bold;color: black" class="form-control form-control-sm mb-0" id="fullname" placeholder="Fullname">
              </div>
            </div>

            <div class="col-12 col-md-2">

              <div class="form-group mb-2">
                <label for="custom_size" style="font-size: .8rem !important">Width</label>
                <!--input type="number"  style="font-size: .8rem !important;height: 1.6rem" class="form-control form-control-sm mb-0" id="custom_size" placeholder="Width"-->
                <select style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black" class="form-control form-control-sm mb-0" id="custom_size" placeholder="Width">
                  <option value="col-12 col-md-1">1</option>
                  <option value="col-12 col-md-2">2</option>
                  <option value="col-12 col-md-3">3</option>
                  <option value="col-12 col-md-4">4</option>
                  <option value="col-12 col-md-5">5</option>
                  <option value="col-12 col-md-6">6</option>
                  <option value="col-12 col-md-7">7</option>
                  <option value="col-12 col-md-8">8</option>
                  <option value="col-12 col-md-9">9</option>
                  <option value="col-12 col-md-10">10</option>
                  <option value="col-11 col-md-11">11</option>
                  <option value="col-12 col-md-12">12</option>
                </select>
              </div>

            </div>

            <div class="col-12 col-md-4">
              <div class="form-group mb-2">
                <label for="taborder" style="font-size: .8rem !important">Move After</label>
                <!--input  type="number"  style="font-size: .8rem !important;height: 1.6rem;font-weight: bold;color: black" class="form-control form-control-sm mb-0" id="taborder" placeholder="Tab Order"-->
                <input  type="hidden" id="taborder">
                <select id="listoffields_taborder" onchange="moveAfterSelectedField();" class="form-control form-control-sm" placeholder="Fields" aria-label="Fields" style="-webkit-box-shadow: none !important;">
                </select>
              </div>
            </div>


          </div>

            <div class="row">
              <div class="col-12 col-md-3">

              <div class="form-group mb-2">
                <label for="type"  style="font-size: .8rem !important">Type</label>
                <select style="font-size: .8rem !important;height: 1.7rem !important;padding-top: .25rem;color: black;" class="form-control form-control-sm mb-0" id="type" placeholder="Type">
                  <option value="string">String</option>
                  <option value="date">Date</option>
                  <option value="email">Email</option>
                  <option value="password">password</option>
                  <option value="text">Text</option>
                  <option value="number">Number</option>
                  <option value="decimal">Decimal</option>
                  <option value="currency">Currency</option>
                  <option value="money">Money</option>
                  <option value="file">File Upload</option>
                  <option value="multiplefiles">Multiple File Upload</option>
                  <option value="checkbox">Check Box</option>
                  <option value="radio">Radio Button</option>
                  <option value="stringchoices">String Choices</option>
                  <option value="numberchoices">Number Choices</option>
                  <option value="select">List</option>
                </select>
              </div>

            </div>
              


            

            </div>


            <div class="row" id="datasource_section_id">

              <!-- loads datasource names -->
              <div class="col-12 col-md-3" id="datasource_type_id">
                <div class="form-group mb-2">
                  <label for="datasource_type" style="font-size: .8rem !important">Datasource Type</label>
                  <!--input type="number"  style="font-size: .8rem !important;height: 1.6rem" class="form-control form-control-sm mb-0" id="custom_size" placeholder="Width"-->
                  <select onchange="getDatasourceNames()" style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black" class="form-control form-control-sm mb-0" id="datasource_type" placeholder="Type">
                    <option value="none">none</option>
                    <option value="table">table</option>
                    <option value="json">json</option>
                    <option value="sql">sql</option>
                    <option value="function">function</option>
                    <option value="list">list</option>
                    <option value="custom">custom</option>
                    
                  </select>
                </div>
              </div>

              <!-- always repopulated when datasource type changes -->
              <div class="col-12 col-md-3" id="datasource_name_id">
                <div class="form-group mb-2">
                  <label for="datasource_name" style="font-size: .8rem !important">Datasource Name</label>
                  <!--input type="number"  style="font-size: .8rem !important;height: 1.6rem" class="form-control form-control-sm mb-0" id="custom_size" placeholder="Width"-->
                  <select onchange="getDatasourceFields()" style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black" class="form-control form-control-sm mb-0" id="datasource_name" placeholder="Name"></select>
                </div>
              </div>

              <div class="col-12 col-md-3" id="datasource_selected_value_id">
                <div class="form-group mb-2">
                  <label for="datasource_selected_value" style="font-size: .8rem !important">Selected Value</label>
                  <select style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black" class="form-control form-control-sm mb-0" id="datasource_selected_value" placeholder="Value"></select>
                </div>
              </div>

              <div class="col-12 col-md-3" id="datasource_selected_display_id">
                <div class="form-group mb-2">
                  <label for="datasource_selected_display" style="font-size: .8rem !important">Display Value</label>
                  <select style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black" class="form-control form-control-sm mb-0" id="datasource_selected_display" placeholder="Display"></select>
                </div>
              </div>

              <div class="col-12 col-md-3" id="datasource_filter_on_value_from_id">
                <div class="form-group mb-2">
                  <label for="datasource_filter_on_value_from" style="font-size: .8rem !important">Filter</label>
                  <select style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black" class="form-control form-control-sm mb-0" id="datasource_filter_on_value_from" placeholder="Filter">
                    <option value=""></option>
                    <option value="byloggedinowner">Data created by all users</option>
                    <option value="byloggedinuser">Data created by user</option>
                    <option value="forloggedinuser">Data created about user</option>
                    <option value="byall">Data created by admin</option>
                  </select>
                </div>
              </div>

            </div>

        <div class="row"> 
            <div class="col-12 col-md-6">
              <div class="form-group mb-2">
                <label for="caption" style="font-size: .8rem !important">Caption</label>
                <input type="text"  style="font-size: .8rem !important;height: 1.6rem" class="form-control form-control-sm mb-0" id="caption" placeholder="Caption">
              </div>
              </div>
          <div class="col-12 col-md-6">
              <div class="form-group mb-2">
                <label for="placeholder" style="font-size: .8rem !important">Placeholder</label>
                <input type="text"  style="font-size: .8rem !important;height: 1.6rem" class="form-control form-control-sm mb-0" id="placeholder" placeholder="Placeholder">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group mb-2">
                <label for="help_text" style="font-size: .8rem !important">Help Text</label>
                <input type="text"  style="font-size: .8rem !important;height: 1.6rem" class="form-control form-control-sm mb-0" id="help_text" placeholder="Help">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group mb-2">
                <label for="section" style="font-size: .8rem !important">Section</label>
                <input type="text"  style="font-size: .8rem !important;height: 1.6rem" class="form-control form-control-sm mb-0" id="section" placeholder="Section">
              </div>              
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group mb-2">
                <label for="section_width" style="font-size: .8rem !important">Section Width</label>
                <select style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black" class="form-control form-control-sm mb-0" id="section_width" placeholder="Width">
                  <option value="col-12 col-md-1">1</option>
                  <option value="col-12 col-md-2">2</option>
                  <option value="col-12 col-md-3">3</option>
                  <option value="col-12 col-md-4">4</option>
                  <option value="col-12 col-md-5">5</option>
                  <option value="col-12 col-md-6">6</option>
                  <option value="col-12 col-md-7">7</option>
                  <option value="col-12 col-md-8">8</option>
                  <option value="col-12 col-md-9">9</option>
                  <option value="col-12 col-md-10">10</option>
                  <option value="col-11 col-md-11">11</option>
                  <option value="col-12 col-md-12">12</option>
                </select>
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group mb-2">
                <label for="section_caption" style="font-size: .8rem !important">Section Caption</label>
                <input type="text"  style="font-size: .8rem !important;height: 1.6rem" class="form-control form-control-sm mb-0" id="section_caption" placeholder="Section Caption">
              </div>
              </div>
              <div class="col-12 col-md-12">
        

              <div class="form-group mb-2">
                <label for="info" style="font-size: .8rem !important">Additional Information</label>
                <input type="text"  style="font-size: .8rem !important;height: 1.6rem" class="form-control form-control-sm mb-0" id="info" placeholder="Additional Information">
              </div>
              </div>
        </div>

              <div class="col-12">
                  <div class="form-group row mb-0">
                    <div class="col-3 pl-0 ">
                      <div class="form-check">
                        <label class="form-check-label"  style="font-size: .8rem !important">
                          <input type="checkbox" class="form-check-input" name="readonly" id="readonly" value=""  style="font-size: .8rem !important">
                          Readonly
                        <i class="input-helper"></i></label>
                      </div>
                    </div>

                    <div class="col-3 pl-0 ">
                      <div class="form-check">
                        <label class="form-check-label"  style="font-size: .8rem !important">
                          <input type="checkbox" class="form-check-input" name="required" id="required" value=""  style="font-size: .8rem !important">
                          Required
                        <i class="input-helper"></i></label>
                      </div>
                    </div>

                    <div class="col-3 pl-0 ">
                      <div class="form-check">
                        <label class="form-check-label"  style="font-size: .8rem !important">
                          <input type="checkbox" class="form-check-input" name="isVisible" id="isVisible" value="" style="font-size: .8rem !important">
                          Visible
                        <i class="input-helper"></i></label>
                      </div>
                    </div>

                    <div class="col-3 pl-0 " style="visibility: hidden;">
                      <div class="form-check">
                        <label class="form-check-label"  style="font-size: .8rem !important">
                          <input type="checkbox" class="form-check-input" name="isActive" id="isActive" value=""  style="font-size: .8rem !important">
                          Active
                        <i class="input-helper"></i></label>
                      </div>
                    </div>

                    

                  </div><!--div class="form-group row"-->
                </div><!--div class="col-12"-->

              <div class="mt-2 text-center">
              
              <a class="btn btn-primary btn-blockx btn-sm mr-2 text-white" href="a-codeeditor-page.php">Close</a>

              <a onclick="saveProperties();" class="btn btn-primary btn-blockx btn-sm mr-2 text-white mt-0">Save</a>
              <!--button class="btn btn-light">Cancel</button-->
            </div>
            </form>

          </div>
        </small>
        </div>
      </div>
    </div>';

    //js
    $editor .='
    <script type="text/javascript">
    var fieldToShow_ = document.getElementById("'.$fieldid.'");

    alert(fieldToShow_.value);
    </script>
    ';

      return $editor;
  }


  /*This function is used at the platform level field FIELDEDITOR
  Fragments: <!--CUSTOM FIELD: fieldeditor--> IN _component_form_dataV5.partial
              function build_object(code), function build_code(obj),function build_ui(code) IN _js.inc
              function getObjects IN _functions_custom_ajax.php

  */
  function getTablesAndFieldsFromCode ($pdo){
      $arrayOfResults = array();
      
        $stmt = $pdo->prepare('SELECT * FROM `objects` WHERE `ownerId`=?');
        $stmt->execute([$_SESSION[APP_SESSION_NAME]["ownerId"] ]);
    
        //$stmt = $pdo->prepare('SELECT * FROM `objects` limit 5 ');
        //$stmt->execute();
    
        $result= $stmt->fetchAll();
        //file_put_contents('11.111', json_encode($result));
        //file_put_contents('11.111', 'json_encode($result) ' );
    
        if ($result && 9==99) {
        
          for ($e=0; $e < count($result) ; $e++) { 
    
            $tmp = explode(',',$result[$e]['fields']);
            $fieldnames=array();
    
            if( (count($tmp) > 0) && isset($tmp[0]) ){
            for ($i=0; $i < count($tmp) ; $i++) { 
              $fieldname = explode(' as ', $tmp[$i]);
              if(isset($fieldname[0])){
                $fieldnames[]=$fieldname[0];
              }//if
            }//for
            }//if
    
    
            $result['tablename']=$result[$e]['fullname'] ;
            $result['fieldnames']=$fieldnames;
    
            $arrayOfResults[]=$result;
    
          }//for
    
        
          
        }
    
      //$payback = $arrayOfResults;
      //print_r($payback);
      return $result;
  }
}
/************************************************************************************************************************************
 * FIELD EDITOR END
 */






/*stringmultiplechoices*/
function get_stringmultiplechoices(){
    $editor ='';


    return $editor;
}

/*numbermultiplechoices*/
function get_numbermultiplechoices(){
    $editor ='';


    return $editor;
}

/*stringsinglechoice*/
function get_stringsinglechoice(){
    $editor ='';


    return $editor;
}

/*numbersinglechoice*/
function get_numbersinglechoice(){
    $editor ='';


    return $editor;
}





?>