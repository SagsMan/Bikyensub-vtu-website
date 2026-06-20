/***************
 * FUNCTION IN THIS FILE WILL BE STRICTLY RELATED TO CUSTOM ALGOCODE FIELDS.
 * CUSTOM FIELDS ARE FIELDS THAT ARE HIDDEN AND VISUALLY/PROCESSED USING PHP/JS AND OUTPUT STORED IN THE HIDDEN FIELDS
 * FOR SUBMISSION TO DATABASE
 */


/************************************************************************************************************************************
 * FIELD EDITOR START
 */
/*This function is used at the platform level field FIELDEDITOR
Fragments: <!--CUSTOM FIELD: fieldeditor--> IN _component_form_dataV5.partial
            function build_object(code), function build_code(obj),function build_ui(code) IN _js.inc
            function getObjects IN _functions_custom_ajax.php
*/
{
  function encode_to_algocodejson(json){
    json = json.replace(/"/g, "'");
    json = json.replace(/:/g, ';');
    json = json.replace(/,/g, '/');
    json = json.replace(/ /g, '$space$');  
    return json;
  }
  function decode_from_algocodejson(json){
    json = json.replace(/\'/g, "\"");
    json = json.replace(/;/g, ":");
    json = json.replace(/\//g, ","); 
    json = json.replace(/\$space\$/g, ' ');  
    return json;
  }
  function build_object(code)
  {
      var fieldlines = code.split(',');

      var fieldproperties = [];
      var fullname='';
      var type='';
      var caption='';
      var help_text='';
      var custom_size='';
      var section='';
      var section_width='';
      var section_caption='';
      var readonly='';
      var required='';
      var isVisible='';
      var isActive='';
      var placeholder='';
      var info='';
      var taborder='';
      var id='';

      var datasource_type='';
      var datasource_name='';
      var datasource_selected_value='';
      var datasource_selected_display='';
      var filter_on='';
      var filter_on_value_from='';
      var datasource_json='';

      var tmp='';

      if(fieldlines.length>0){
        for (var i = 0; i < fieldlines.length; i++) 
        {
          
          //reset for each field
          fullname='';
          type='';
          caption='';
          help_text='';
          custom_size='';
          section='';
          section_width='';
          section_caption='';
          readonly='';
          required='';
          isVisible='';
          isActive='';
          placeholder='';
          info='';
          taborder='';
          id='';

          datasource_type='';
          datasource_name='';
          datasource_selected_value='';
          datasource_selected_display='';
          filter_on='all';
          filter_on_value_from='byAll';
          datasource_json='';
          //filter_on all filter_on_value_from byAll
          //get fullname/type
          tmp = fieldlines[i].split(':');
          if( (tmp.length > 0) && tmp[0] ){
            /*fullname/type exists [0]*/
            tmp = tmp[0].split(' as ');
            if(tmp.length>1){
              if(tmp[0]){fullname = tmp[0];}
              if(tmp[1]){
                /*type handler*/
                var word = tmp[1].split(' ');
                if((word[0])){
                  type = word[0].trim();
                  switch (word[0].trim()) {
                    case 'stringchoices': 
                    case 'numberchoices':
                      if(word[3] && word[4] && word[6] && word[8] ){
                          datasource_type=word[3].trim();
                          datasource_name=word[4].trim();
                          datasource_selected_value=word[6].trim();
                          datasource_selected_display=word[8].trim();
                          if(datasource_type=='table'){
                            if(word[10] && word[12] ){
                              filter_on=word[10].trim();
                              filter_on_value_from=word[12].trim();
                            }
                          }
                          if(datasource_type=='json'){
                            if(word[9] ){
                              datasource_json=word[9].trim();
                              //datasource_json=decode_algocodejson(datasource_json )                            
                              //console.log(datasource_json)
                            }
                          }
                      }
                      break;

                    default: break;    
                }//switch
              }//if            
              }                      
            }
          }

          //get properties
          tmp = fieldlines[i].split(':');
          if( (tmp.length > 1) && tmp[1] ){
            /*properties exists [1]*/
            tmp = tmp[1].split('@');

            if(tmp.length >0){
              var istabordered = false;
              for (var ip = 0; ip < tmp.length; ip++) {
                var tmp_ = tmp[ip].split(' is_ ');
                if(tmp_[1]){
                  //console.log(tmp_[0]);
                  switch (tmp_[1].trim()) {
                    case 'caption': caption  = tmp_[0].trim();break;
                    case 'help_text': help_text  = tmp_[0].trim();break;
                    case 'custom_size': custom_size  = tmp_[0].trim();break;
                    case 'section': section  = tmp_[0].trim();break;
                    case 'section_width': section_width  = tmp_[0].trim();break;
                    case 'section_caption': section_caption  = tmp_[0].trim();break;
                    case 'readonly': readonly  = tmp_[0].trim();break;
                    case 'required': required  = tmp_[0].trim();break;
                    case 'isVisible': isVisible  = tmp_[0].trim();break;
                    case 'isActive': isActive  = tmp_[0].trim();break;
                    case 'placeholder': placeholder  = tmp_[0].trim();break;
                    case 'info': info  = tmp_[0].trim();break;
                    case 'taborder': taborder  = tmp_[0].trim();taborder=true;break;
                    case 'id': id  = tmp_[0].trim();break;

                    case 'datasource_type': datasource_type  = tmp_[0].trim();break;
                    case 'datasource_name': datasource_name  = tmp_[0].trim();break;
                    case 'datasource_selected_value': datasource_selected_value  = tmp_[0].trim();break;
                    case 'datasource_selected_display': datasource_selected_display  = tmp_[0].trim();break;
                    case 'filter_on': filter_on  = tmp_[0].trim();break;
                    case 'filter_on_value_from': filter_on_value_from  = tmp_[0].trim();break;
                    case 'datasource_json': datasource_json  = tmp_[0].trim();break;
                    
                    default:
                      // code...
                      break;
                  }                               
                }//if            
              }//for

              if(istabordered==false){taborder=i;}

              
            }
          }



          
          fieldproperties.push({'fullname':fullname,'type':type,'caption': caption  , 'help_text': help_text , 'custom_size': custom_size  , 'section': section  , 'section_width': section_width  , 'section_caption': section_caption  ,  'readonly': readonly  ,        'required': required  ,        'isVisible': isVisible  ,        'isActive': isActive  ,        'placeholder': placeholder  ,        'info': info  ,        'taborder': taborder  ,        'id': id  ,        'datasource_type': datasource_type  ,        'datasource_name': datasource_name  ,        'datasource_selected_value': datasource_selected_value  ,        'datasource_selected_display': datasource_selected_display  ,        'filter_on': filter_on  ,        'filter_on_value_from': filter_on_value_from ,        'datasource_json': datasource_json  ,        });
          


        }/*for (var i = 0; i < fieldlines.length; i++) {*/
      }/*if(fieldlines.length>0){*/
    
        
    
    

        return fieldproperties;
  }

  function build_code(object){

      object.sort((a, b) => {return a.taborder - b.taborder;});
      var code ='';
      for (var i = 0; i < object.length; i++) {
        code += object[i].fullname + ' as '+ object[i].type;

        if(object[i].type=='stringchoices' || object[i].type=='numberchoices'){

          if( object[i].datasource_type !='' && object[i].datasource_name !='' && object[i].datasource_selected_value !='' && object[i].datasource_selected_display !='' && object[i].datasource_type !='none' && object[i].datasource_name !='none' && object[i].datasource_selected_value !='none' && object[i].datasource_selected_display !='none'  ){
            code += ' connect to '+object[i].datasource_type+' '+object[i].datasource_name+' on '+object[i].datasource_selected_value+' dislaying '+object[i].datasource_selected_display;

            if(object[i].datasource_type=='json'){
              code += ' '+object[i].datasource_json;
            }
            if(object[i].datasource_type=='table'){
              if( object[i].filter_on !='' && object[i].filter_on_value_from !='' && object[i].filter_on !='none' && object[i].filter_on_value_from !='none'){
                code += ' filter_on '+object[i].filter_on+' filter_on_value_from '+object[i].filter_on_value_from;
              }
            }
          }

        }/*if*/

        code += ':';

        if(object[i].caption){code += object[i].caption +' is_ caption@';} 
        if(object[i].help_text){code += object[i].help_text +' is_ help_text@';} 
        if(object[i].custom_size){code += object[i].custom_size +' is_ custom_size@';} 
        if(object[i].section){code += object[i].section +' is_ section@';} 
        if(object[i].section_width){code += object[i].section_width +' is_ section_width@';} 
        if(object[i].section_caption){code += object[i].section_caption +' is_ section_caption@';} 
        if(object[i].readonly){code += object[i].readonly +' is_ readonly@';} 
        if(object[i].required){code += object[i].required +' is_ required@';} 
        if(object[i].isVisible){code += object[i].isVisible +' is_ isVisible@';} 
        if(object[i].isActive){code += object[i].isActive +' is_ isActive@';} 
        if(object[i].placeholder){code += object[i].placeholder +' is_ placeholder@';} 
        if(object[i].info){code += object[i].info +' is_ info@';} 
        if(object[i].taborder){code += object[i].taborder +' is_ taborder@';} 

        code=code.substr(0, code.length - 1);

        code += ',';

      }/*for*/
      code=code.substr(0, code.length - 1);

      /*console.log(code)*/

      return code;
  }


  function build_ui(object){

      object.sort((a, b) => {return a.taborder - b.taborder;});

      /*fields*/
      var ui='';
      
      var listOffieldsOptions = '';
      var fields_list='<ul class="list-tickedx">';

      /*object.sort((a, b) => {
      return a.taborder - b.taborder;
      });*/

      for (var i = 0; i < object.length; i++) {
        fields_list +='<li><a href="" onclick="loado('+i+');">'+object[i].fullname+'</a></li>';

        if((object[i].taborder.length < 1)){object[i].taborder=i;}
        listOffieldsOptions += '<option value="' +object[i].taborder+ '">' +object[i].fullname.trim()+ '</option>'
      }/*for*/
      fields_list +='</ul>';

      var jsondataeditor ='<div style="height: 200px;"  id="jsondataeditor_codeeditor"></div>';

      ui += '<div class="" style="font-size: .1remx !important;height: 15rem !important">';
        ui += '<div class="row">';
          ui += '<div class="col-12 col-md-3" style="height:15rem;overflow-x: hidden !important;">';
            ui += fields_list;
          ui += '</div><!--div class="col"-->';
          ui += '<div class="col-12 col-md-9" style="height:15rem;overflow-x: hidden !important;">';
              ui +='<div class="mb-1 col-12x stretch-card mr-0" style="font-size: .1rem !important;">  <div class="card mt-0 p-0 mr-0" style="overflow: auto !important;">    <div class="card-body p-0 pt-2 pl-2 p-3 mt-0 mr-0">      <!-- Form -->      <small>        <div class="col-12 mb-2 p-0 pr-2">          <form class="forms-sample">            <input type="hidden" name="id" id="id">            <input type="hidden" name="filter_on" id="filter_on" value="">            <p class="card-title mb-0" style="font-size: .7rem !important;">Properties</p>            <div class="row">              <div class="col-12 col-md-3">                <div class="form-group mb-2">                  <label for="fullname" style="font-size: .8rem !important">Fullname</label>                  <input readonly type="text"                    style="font-size: .8rem !important;height: 1.6rem;font-weight: bold;color: black"                    class="form-control form-control-sm mb-0" id="fullname" placeholder="Fullname">                </div>              </div>              <div class="col-12 col-md-3">                <div class="form-group mb-2">                  <label for="custom_size" style="font-size: .8rem !important">Width</label>                  <select style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black"                    class="form-control form-control-sm mb-0" id="custom_size" placeholder="Width">                    <option value="col-12 col-md-1">1</option>                    <option value="col-12 col-md-2">2</option>                    <option value="col-12 col-md-3">3</option>                    <option value="col-12 col-md-4">4</option>                    <option value="col-12 col-md-5">5</option>                    <option value="col-12 col-md-6">6</option>                    <option value="col-12 col-md-7">7</option>                    <option value="col-12 col-md-8">8</option>                    <option value="col-12 col-md-9">9</option>                    <option value="col-12 col-md-10">10</option>                    <option value="col-11 col-md-11">11</option>                    <option value="col-12 col-md-12">12</option>                  </select>                </div>              </div>            <!--/div-->            <!--div class="row"-->';              ui +='<div class="col-12 col-md-3">                                                                                                                      <div class="form-group mb-2"><label for="type" style="font-size: .8rem !important">Type</label><select style="font-size: .8rem !important;height: 1.7rem !important;padding-top: .25rem;color: black;" class="form-control form-control-sm mb-0" id="type" placeholder="Type"><option value="string">String</option><option value="date">Date</option><option value="email">Email</option><option value="password">password</option><option value="text">Text</option><option value="number">Number</option><option value="checkbox">Check Box</option><option value="radio">Radio Button</option><option value="decimal">Decimal</option><option value="currency">Currency</option><option value="money">Money</option><option value="stringchoices">String Choices</option><option value="numberchoices">Number Choices</option><option value="selectchoice">Select Choice</option> <option value="selectchoices">Select Choices</option> <option value="file">File Upload</option> <option value="jsonform">Form</option><option value="select">List</option></select></div>                                                                                          </div>';                                                                                                                                            ui +='<div class="col-12 col-md-3">                <div class="form-group mb-2">                  <label for="taborder" style="font-size: .8rem !important">Move After</label>                  <input type="hidden" id="taborder">                  <select id="listoffields_taborder" onchange="moveAfterSelectedField();"                    class="form-control form-control-sm" placeholder="Fields" aria-label="Fields"                    style="-webkit-box-shadow: none !important;">'+listOffieldsOptions+'</select>                </div>              </div>            </div>   ';
              ui +='<div class="row" id="datasource_section_id">              <!-- loads datasource names -->              ';
              ui +='<div class="col-12 col-md-3" id="datasource_type_id">                <div class="form-group mb-2">                  <label for="datasource_type" style="font-size: .8rem !important">Datasource Type</label>                  <select style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black"                    class="form-control form-control-sm mb-0" id="datasource_type" placeholder="Type">                    <option value="none">none</option>                    <option value="table">table</option>                    <option value="json">json</option>                    <option value="sql">sql</option>                    <option value="function">function</option>                    <option value="list">list</option>                    <option value="custom">custom</option>                  </select>                </div>              </div> ';             
              ui +='<!-- always repopulated when datasource type changes -->              <div class="col-12 col-md-3" id="datasource_name_id">                <div class="form-group mb-2">                  <label for="datasource_name" style="font-size: .8rem !important">Datasource Name</label>                  <select style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black"                    class="form-control form-control-sm mb-0" id="datasource_name" placeholder="Name"></select>                </div>              </div> ';             ui +='<div class="col-12 col-md-3" id="datasource_selected_value_id">                <div class="form-group mb-2">                  <label for="datasource_selected_value" style="font-size: .8rem !important">Selected Value</label>                  <select style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black"                    class="form-control form-control-sm mb-0" id="datasource_selected_value"                    placeholder="Value"></select>                </div>              </div>              <div class="col-12 col-md-3" id="datasource_selected_display_id">                <div class="form-group mb-2">                  <label for="datasource_selected_display" style="font-size: .8rem !important">Display Value</label>                  <select style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black"                    class="form-control form-control-sm mb-0" id="datasource_selected_display"                    placeholder="Display"></select>                </div>              </div>              <div class="col-12 col-md-3" id="datasource_filter_on_value_from_id">                <div class="form-group mb-2">                  <label for="datasource_filter_on_value_from" style="font-size: .8rem !important">Filter</label>                  <select style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black"                    class="form-control form-control-sm mb-0" id="datasource_filter_on_value_from" placeholder="Filter">                    <option value=""></option>                    <option value="byloggedinowner">Data created by all users</option>                    <option value="byloggedinuser">Data created by user</option>                    <option value="forloggedinuser">Data created about user</option>                    <option value="byall">Data created by admin</option>                  </select>                </div>              </div>            </div>   ';    
              
              ui +='<div class="form-group mb-2">              <label for="datasource_json" style="font-size: .8rem !important">JSON</label>              <!--textarea style="font-size: .8rem !important;height: 16rem"                class="form-control form-control-sm mb-0" id="datasource_json" placeholder=""></textarea--><input type="hidden" id="datasource_json" value="">      '+jsondataeditor+'      </div>             ';
              
              ui +='<div class="form-group mb-2">              <label for="caption" style="font-size: .8rem !important">Caption</label>              <input type="text" style="font-size: .8rem !important;height: 1.6rem"                class="form-control form-control-sm mb-0" id="caption" placeholder="Caption">            </div>            <div class="form-group mb-2">              <label for="placeholder" style="font-size: .8rem !important">Placeholder</label>              <input type="text" style="font-size: .8rem !important;height: 1.6rem"                class="form-control form-control-sm mb-0" id="placeholder" placeholder="Placeholder">            </div>            <div class="form-group mb-2">              <label for="help_text" style="font-size: .8rem !important">Help Text</label>              <input type="text" style="font-size: .8rem !important;height: 1.6rem"                class="form-control form-control-sm mb-0" id="help_text" placeholder="Help">            </div>            <div class="form-group mb-2">              <label for="section" style="font-size: .8rem !important">Section</label>              <input type="text" style="font-size: .8rem !important;height: 1.6rem"                class="form-control form-control-sm mb-0" id="section" placeholder="Section">            </div>            <div class="form-group mb-2">              <label for="section_width" style="font-size: .8rem !important">Section Width</label>              <select style="font-size: .8rem !important;height: 1.7rem;padding-top: .25rem;color: black"                class="form-control form-control-sm mb-0" id="section_width" placeholder="Width">                <option value="col-12 col-md-1">1</option>                <option value="col-12 col-md-2">2</option>                <option value="col-12 col-md-3">3</option>                <option value="col-12 col-md-4">4</option>                <option value="col-12 col-md-5">5</option>                <option value="col-12 col-md-6">6</option>                <option value="col-12 col-md-7">7</option>                <option value="col-12 col-md-8">8</option>                <option value="col-12 col-md-9">9</option>                <option value="col-12 col-md-10">10</option>                <option value="col-11 col-md-11">11</option>                <option value="col-12 col-md-12">12</option>              </select>            </div>            <div class="form-group mb-2">              <label for="section_caption" style="font-size: .8rem !important">Section Caption</label>              <input type="text" style="font-size: .8rem !important;height: 1.6rem"                class="form-control form-control-sm mb-0" id="section_caption" placeholder="Section Caption">            </div>            <div class="form-group mb-2">              <label for="info" style="font-size: .8rem !important">Additional Information</label>              <input type="text" style="font-size: .8rem !important;height: 1.6rem"                class="form-control form-control-sm mb-0" id="info" placeholder="Additional Information">            </div>            <div class="col-12">              <div class="form-group row mb-0">                <div class="col-sm-6 pl-0 ">                  <div class="form-check">                    <label class="form-check-label" style="font-size: .8rem !important">                      <input type="checkbox" class="form-check-input" name="readonly" id="readonly" value=""                        style="font-size: .8rem !important">                      Readonly                      <i class="input-helper"></i></label>                  </div>                </div>                <div class="col-sm-4 pl-0 ">                  <div class="form-check">                    <label class="form-check-label" style="font-size: .8rem !important">                      <input type="checkbox" class="form-check-input" name="required" id="required" value=""                        style="font-size: .8rem !important">                      Required                      <i class="input-helper"></i></label>                  </div>                </div>                <div class="col-sm-4 pl-0 ">                  <div class="form-check">                    <label class="form-check-label" style="font-size: .8rem !important">                      <input type="checkbox" class="form-check-input" name="isVisible" id="isVisible" value=""                        style="font-size: .8rem !important">                      Visible                      <i class="input-helper"></i></label>                  </div>                </div>                <div class="col-sm-4 pl-0 " style="visibility: hidden;">                  <div class="form-check">                    <label class="form-check-label" style="font-size: .8rem !important">                      <input type="checkbox" class="form-check-input" name="isActive" id="isActive" value=""                        style="font-size: .8rem !important">                      Active                      <i class="input-helper"></i></label>                  </div>                </div>              </div>            </div>            <div class="mt-2 text-center">              <!--a class="btn btn-primary btn-blockx btn-sm mr-2 text-white" href="a-codeeditor-page.php">Close</a>              <a onclick="saveProperties();" class="btn btn-primary btn-blockx btn-sm mr-2 text-white mt-0">Save</a-->            </div>          </form>        </div>      </small>    </div>  </div></div>';
          ui += '</div><!--div class="col"-->';
        ui += '</div><!--div class="row"-->';    
      ui += '</div><!--div class="container"-->';
      return ui;
  }
}
/********************FIELDEDITOR END */
