YUI.add("moodle-atto_media-button",function(r,e){var t="atto_media",i={LINK:"LINK",VIDEO:"VIDEO",AUDIO:"AUDIO"},a={SUBTITLES:"SUBTITLES",CAPTIONS:"CAPTIONS",DESCRIPTIONS:"DESCRIPTIONS",CHAPTERS:"CHAPTERS",METADATA:"METADATA"},s={SOURCE:"atto_media_source",TRACK:"atto_media_track",MEDIA_SOURCE:"atto_media_media_source",LINK_SOURCE:"atto_media_link_source",POSTER_SOURCE:"atto_media_poster_source",TRACK_SOURCE:"atto_media_track_source",DISPLAY_OPTIONS:"atto_media_display_options",NAME_INPUT:"atto_media_name_entry",TITLE_INPUT:"atto_media_title_entry",URL_INPUT:"atto_media_url_entry",POSTER_SIZE:"atto_media_poster_size",LINK_SIZE:"atto_media_link_size",WIDTH_INPUT:"atto_media_width_entry",HEIGHT_INPUT:"atto_media_height_entry",MINUTE_INPUT:"atto_media_minute_entry",SECOND_INPUT:"atto_media_second_entry",TRACK_KIND_INPUT:"atto_media_track_kind_entry",TRACK_LABEL_INPUT:"atto_media_track_label_entry",TRACK_LANG_INPUT:"atto_media_track_lang_entry",TRACK_DEFAULT_SELECT:"atto_media_track_default",MEDIA_CONTROLS_TOGGLE:"atto_media_controls",MEDIA_AUTOPLAY_TOGGLE:"atto_media_autoplay",MEDIA_MUTE_TOGGLE:"atto_media_mute",MEDIA_LOOP_TOGGLE:"atto_media_loop",ADVANCED_SETTINGS:"atto_media_advancedsettings",QUESTIONS:"atto_media_questions",QUESTIONS_CLASS:"atto_media_questions_class",LINK:i.LINK.toLowerCase(),VIDEO:i.VIDEO.toLowerCase(),AUDIO:i.AUDIO.toLowerCase(),TRACK_SUBTITLES:a.SUBTITLES.toLowerCase(),TRACK_CAPTIONS:a.CAPTIONS.toLowerCase(),TRACK_DESCRIPTIONS:a.DESCRIPTIONS.toLowerCase(),TRACK_CHAPTERS:a.CHAPTERS.toLowerCase(),TRACK_METADATA:a.METADATA.toLowerCase()},l={SOURCE:"."+s.SOURCE,TRACK:"."+s.TRACK,MEDIA_SOURCE:"."+s.MEDIA_SOURCE,POSTER_SOURCE:"."+s.POSTER_SOURCE,TRACK_SOURCE:"."+s.TRACK_SOURCE,DISPLAY_OPTIONS:"."+s.DISPLAY_OPTIONS,NAME_INPUT:"."+s.NAME_INPUT,TITLE_INPUT:"."+s.TITLE_INPUT,URL_INPUT:"."+s.URL_INPUT,POSTER_SIZE:"."+s.POSTER_SIZE,LINK_SIZE:"."+s.LINK_SIZE,WIDTH_INPUT:"."+s.WIDTH_INPUT,HEIGHT_INPUT:"."+s.HEIGHT_INPUT,MINUTE_INPUT:"."+s.MINUTE_INPUT,SECOND_INPUT:"."+s.SECOND_INPUT,TRACK_KIND_INPUT:"."+s.TRACK_KIND_INPUT,TRACK_LABEL_INPUT:"."+s.TRACK_LABEL_INPUT,TRACK_LANG_INPUT:"."+s.TRACK_LANG_INPUT,TRACK_DEFAULT_SELECT:"."+s.TRACK_DEFAULT_SELECT,MEDIA_CONTROLS_TOGGLE:"."+s.MEDIA_CONTROLS_TOGGLE,MEDIA_AUTOPLAY_TOGGLE:"."+s.MEDIA_AUTOPLAY_TOGGLE,MEDIA_MUTE_TOGGLE:"."+s.MEDIA_MUTE_TOGGLE,MEDIA_LOOP_TOGGLE:"."+s.MEDIA_LOOP_TOGGLE,ADVANCED_SETTINGS:"."+s.ADVANCED_SETTINGS,QUESTIONS:"."+s.QUESTIONS,LINK_TAB:'li[data-medium-type="'+s.LINK+'"]',LINK_PANE:'.tab-pane[data-medium-type="'+s.LINK+'"]',VIDEO_TAB:'li[data-medium-type="'+s.VIDEO+'"]',VIDEO_PANE:'.tab-pane[data-medium-type="'+s.VIDEO+'"]',AUDIO_TAB:'li[data-medium-type="'+s.AUDIO+'"]',AUDIO_PANE:'.tab-pane[data-medium-type="'+s.AUDIO+'"]',TRACK_SUBTITLES_TAB:'li[data-track-kind="'+s.TRACK_SUBTITLES+'"]',TRACK_SUBTITLES_PANE:'.tab-pane[data-track-kind="'+s.TRACK_SUBTITLES+'"]',TRACK_CAPTIONS_TAB:'li[data-track-kind="'+s.TRACK_CAPTIONS+'"]',TRACK_CAPTIONS_PANE:'.tab-pane[data-track-kind="'+s.TRACK_CAPTIONS+'"]',TRACK_DESCRIPTIONS_TAB:'li[data-track-kind="'+s.TRACK_DESCRIPTIONS+'"]',TRACK_DESCRIPTIONS_PANE:'.tab-pane[data-track-kind="'+s.TRACK_DESCRIPTIONS+'"]',TRACK_CHAPTERS_TAB:'li[data-track-kind="'+s.TRACK_CHAPTERS+'"]',TRACK_CHAPTERS_PANE:'.tab-pane[data-track-kind="'+s.TRACK_CHAPTERS+'"]',TRACK_METADATA_TAB:'li[data-track-kind="'+s.TRACK_METADATA+'"]',TRACK_METADATA_PANE:'.tab-pane[data-track-kind="'+s.TRACK_METADATA+'"]'},c={ROOT:'<form class="mform atto_form atto_media" id="{{elementid}}_atto_media_form"><ul class="root nav nav-tabs mb-1" role="tablist"><li data-medium-type="{{CSS.LINK}}" class="nav-item"><a class="nav-link active" href="#{{elementid}}_{{CSS.LINK}}" role="tab" data-toggle="tab">{{get_string "link" component}}</a></li><li data-medium-type="{{CSS.VIDEO}}" class="nav-item"><a class="nav-link" href="#{{elementid}}_{{CSS.VIDEO}}" role="tab" data-toggle="tab">{{get_string "video" component}}</a></li><li data-medium-type="{{CSS.AUDIO}}" class="nav-item"><a class="nav-link" href="#{{elementid}}_{{CSS.AUDIO}}" role="tab" data-toggle="tab">{{get_string "audio" component}}</a></li></ul><div class="root tab-content"><div data-medium-type="{{CSS.LINK}}" class="tab-pane active" id="{{elementid}}_{{CSS.LINK}}">{{> tab_panes.link}}</div><div data-medium-type="{{CSS.VIDEO}}" class="tab-pane" id="{{elementid}}_{{CSS.VIDEO}}">{{> tab_panes.video}}</div><div data-medium-type="{{CSS.AUDIO}}" class="tab-pane" id="{{elementid}}_{{CSS.AUDIO}}">{{> tab_panes.audio}}</div></div><div class="mdl-align"><br/><button class="btn btn-secondary submit" type="submit">{{get_string "createmedia" component}}</button></div></form>',TAB_PANES:{LINK:'{{renderPartial "form_components.source" context=this id=CSS.LINK_SOURCE}}<label for="{{elementid}}_link_nameentry">{{get_string "entername" component}}</label><input class="form-control fullwidth {{CSS.NAME_INPUT}}" type="text" id="{{elementid}}_link_nameentry"size="32" required="true"/>',
VIDEO:'{{renderPartial "form_components.source" context=this id=CSS.MEDIA_SOURCE entersourcelabel="videosourcelabel" addcomponentlabel="addsource" multisource="true" addsourcehelp=helpStrings.addsource}}<fieldset class="collapsible collapsed" id="{{elementid}}_video-display-options"><input name="mform_isexpanded_{{elementid}}_video-display-options" type="hidden"><legend class="ftoggler">{{get_string "displayoptions" component}}</legend><div class="fcontainer">{{renderPartial "form_components.display_options" context=this id=CSS.VIDEO mediatype_video=true}}</div></fieldset><fieldset class="collapsible collapsed" id="{{elementid}}_video-advanced-settings"><input name="mform_isexpanded_{{elementid}}_video-advanced-settings" type="hidden"><legend class="ftoggler">{{get_string "advancedsettings" component}}</legend><div class="fcontainer">{{renderPartial "form_components.advanced_settings" context=this id=CSS.VIDEO}}</div></fieldset><fieldset class="collapsible collapsed" id="{{elementid}}_video-questions"><input name="mform_isexpanded_{{elementid}}_video-questions" type="hidden"><legend class="ftoggler">Questions</legend><div class="fcontainer">{{renderPartial "form_components.questions" context=this id=CSS.VIDEO}}</div></fieldset><fieldset class="collapsible collapsed" id="{{elementid}}_video-tracks"><input name="mform_isexpanded_{{elementid}}_video-tracks" type="hidden"><legend class="ftoggler">{{get_string "tracks" component}} {{{helpStrings.tracks}}}</legend><div class="fcontainer">{{renderPartial "form_components.track_tabs" context=this id=CSS.VIDEO}}</div></fieldset>',AUDIO:'{{renderPartial "form_components.source" context=this id=CSS.MEDIA_SOURCE entersourcelabel="audiosourcelabel" addcomponentlabel="addsource" multisource="true" addsourcehelp=helpStrings.addsource}}<fieldset class="collapsible collapsed" id="{{elementid}}_audio-display-options"><input name="mform_isexpanded_{{elementid}}_audio-display-options" type="hidden"><legend class="ftoggler">{{get_string "displayoptions" component}}</legend><div class="fcontainer">{{renderPartial "form_components.display_options" context=this id=CSS.AUDIO}}</div></fieldset><fieldset class="collapsible collapsed" id="{{elementid}}_audio-advanced-settings"><input name="mform_isexpanded_{{elementid}}_audio-advanced-settings" type="hidden"><legend class="ftoggler">{{get_string "advancedsettings" component}}</legend><div class="fcontainer">{{renderPartial "form_components.advanced_settings" context=this id=CSS.AUDIO}}</div></fieldset><fieldset class="collapsible collapsed" id="{{elementid}}_audio-tracks"><input name="mform_isexpanded_{{elementid}}_audio-tracks" type="hidden"><legend class="ftoggler">{{get_string "tracks" component}} {{{helpStrings.tracks}}}</legend><div class="fcontainer">{{renderPartial "form_components.track_tabs" context=this id=CSS.AUDIO}}</div></fieldset>'},FORM_COMPONENTS:{SOURCE:'<div class="{{CSS.SOURCE}} {{id}}"><div class="mb-1"><label for="url-input">{{#entersourcelabel}}{{get_string ../entersourcelabel ../component}}{{/entersourcelabel}}{{^entersourcelabel}}{{get_string "entersource" ../component}}{{/entersourcelabel}}</label><div class="input-group input-append w-100"><input id="url-input" class="form-control {{CSS.URL_INPUT}}" type="url" size="32"/><span class="input-group-append"><button class="btn btn-secondary openmediabrowser" type="button">{{get_string "browserepositories" component}}</button></span></div></div>{{#multisource}}{{renderPartial "form_components.add_component" context=../this label=../addcomponentlabel  help=../addsourcehelp}}{{/multisource}}</div>',ADD_COMPONENT:'<div><a href="#" class="addcomponent">{{#label}}{{get_string ../label ../component}}{{/label}}{{^label}}{{get_string "add" ../component}}{{/label}}</a>{{#help}}{{{../help}}}{{/help}}</div>',REMOVE_COMPONENT:'<div><a href="#" class="removecomponent">{{#label}}{{get_string ../label ../component}}{{/label}}{{^label}}{{get_string "remove" ../component}}{{/label}}</a></div>',DISPLAY_OPTIONS:'<div class="{{CSS.DISPLAY_OPTIONS}}"><div class="mb-1"><label for="{{id}}_media-title-entry">{{get_string "entertitle" component}}</label><input class="form-control fullwidth {{CSS.TITLE_INPUT}}" type="text" id="{{id}}_media-title-entry"size="32"/></div><div class="clearfix"></div>{{#mediatype_video}}<div class="mb-1"><label>{{get_string "size" component}}</label><div class="form-inline {{CSS.POSTER_SIZE}}"><label class="accesshide">{{get_string "videowidth" component}}</label><input type="text" class="form-control mr-1 {{CSS.WIDTH_INPUT}} input-mini" size="4"/> x <label class="accesshide">{{get_string "videoheight" component}}</label><input type="text" class="form-control ml-1 {{CSS.HEIGHT_INPUT}} input-mini" size="4"/></div></div><div class="clearfix"></div>{{renderPartial "form_components.source" context=this id=CSS.POSTER_SOURCE entersourcelabel="poster"}}{{/mediatype_video}}<div>',QUESTIONS:'<div class="{{CSS.QUESTIONS_CLASS}}"><div class="mb-1"><label for="{{id}}_media-questions">Enter your question: </label><textarea class="form-control fullwidth {{CSS.QUESTIONS}}" id="{{id}}_media-questions"size="125"></textarea></div><div class="mb-1"><label>Time to place question at</label><div class="form-inline {{CSS.POSTER_SIZE}}"><label class="accesshide">{{get_string "videowidth" component}}</label><input type="text" class="form-control mr-1 {{CSS.MINUTE_INPUT}} input-mini" size="2"/>:<label class="accesshide">{{get_string "videoheight" component}}</label><input type="text" class="form-control ml-1 {{CSS.SECOND_INPUT}} input-mini" size="2"/></div></div><div class="clearfix"></div><div>',
ADVANCED_SETTINGS:'<div class="{{CSS.ADVANCED_SETTINGS}}"><div class="form-check"><input type="checkbox" checked="true" class="form-check-input {{CSS.MEDIA_CONTROLS_TOGGLE}}"id="{{id}}_media-controls-toggle"/><label class="form-check-label" for="{{id}}_media-controls-toggle">{{get_string "controls" component}}</label></div><div class="form-check"><input type="checkbox" class="form-check-input {{CSS.MEDIA_AUTOPLAY_TOGGLE}}"id="{{id}}_media-autoplay-toggle"/><label class="form-check-label" for="{{id}}_media-autoplay-toggle">{{get_string "autoplay" component}}</label></div><div class="form-check"><input type="checkbox" class="form-check-input {{CSS.MEDIA_MUTE_TOGGLE}}" id="{{id}}_media-mute-toggle"/><label class="form-check-label" for="{{id}}_media-mute-toggle">{{get_string "mute" component}}</label></div><div class="form-check"><input type="checkbox" class="form-check-input {{CSS.MEDIA_LOOP_TOGGLE}}" id="{{id}}_media-loop-toggle"/><label class="form-check-label" for="{{id}}_media-loop-toggle">{{get_string "loop" component}}</label></div></div>',TRACK_TABS:'<ul class="nav nav-tabs mb-3"><li data-track-kind="{{CSS.TRACK_SUBTITLES}}" class="nav-item"><a class="nav-link active" href="#{{elementid}}_{{id}}_{{CSS.TRACK_SUBTITLES}}" role="tab" data-toggle="tab">{{get_string "subtitles" component}}</a></li><li data-track-kind="{{CSS.TRACK_CAPTIONS}}" class="nav-item"><a class="nav-link" href="#{{elementid}}_{{id}}_{{CSS.TRACK_CAPTIONS}}" role="tab" data-toggle="tab">{{get_string "captions" component}}</a></li><li data-track-kind="{{CSS.TRACK_DESCRIPTIONS}}"  class="nav-item"><a class="nav-link" href="#{{elementid}}_{{id}}_{{CSS.TRACK_DESCRIPTIONS}}" role="tab" data-toggle="tab">{{get_string "descriptions" component}}</a></li><li data-track-kind="{{CSS.TRACK_CHAPTERS}}" class="nav-item"><a class="nav-link" href="#{{elementid}}_{{id}}_{{CSS.TRACK_CHAPTERS}}" role="tab" data-toggle="tab">{{get_string "chapters" component}}</a></li><li data-track-kind="{{CSS.TRACK_METADATA}}" class="nav-item"><a class="nav-link" href="#{{elementid}}_{{id}}_{{CSS.TRACK_METADATA}}" role="tab" data-toggle="tab">{{get_string "metadata" component}}</a></li></ul><div class="tab-content"><div data-track-kind="{{CSS.TRACK_SUBTITLES}}" class="tab-pane active" id="{{elementid}}_{{id}}_{{CSS.TRACK_SUBTITLES}}"><div class="trackhelp">{{{helpStrings.subtitles}}}</div>{{renderPartial "form_components.track" context=this sourcelabel="subtitlessourcelabel" addcomponentlabel="addsubtitlestrack"}}</div><div data-track-kind="{{CSS.TRACK_CAPTIONS}}" class="tab-pane" id="{{elementid}}_{{id}}_{{CSS.TRACK_CAPTIONS}}"><div class="trackhelp">{{{helpStrings.captions}}}</div>{{renderPartial "form_components.track" context=this sourcelabel="captionssourcelabel" addcomponentlabel="addcaptionstrack"}}</div><div data-track-kind="{{CSS.TRACK_DESCRIPTIONS}}" class="tab-pane" id="{{elementid}}_{{id}}_{{CSS.TRACK_DESCRIPTIONS}}"><div class="trackhelp">{{{helpStrings.descriptions}}}</div>{{renderPartial "form_components.track" context=this sourcelabel="descriptionssourcelabel" addcomponentlabel="adddescriptionstrack"}}</div><div data-track-kind="{{CSS.TRACK_CHAPTERS}}" class="tab-pane" id="{{elementid}}_{{id}}_{{CSS.TRACK_CHAPTERS}}"><div class="trackhelp">{{{helpStrings.chapters}}}</div>{{renderPartial "form_components.track" context=this sourcelabel="chapterssourcelabel" addcomponentlabel="addchapterstrack"}}</div><div data-track-kind="{{CSS.TRACK_METADATA}}" class="tab-pane" id="{{elementid}}_{{id}}_{{CSS.TRACK_METADATA}}"><div class="trackhelp">{{{helpStrings.metadata}}}</div>{{renderPartial "form_components.track" context=this sourcelabel="metadatasourcelabel" addcomponentlabel="addmetadatatrack"}}</div></div>',TRACK:'<div class="mb-1 {{CSS.TRACK}}">{{renderPartial "form_components.source" context=this id=CSS.TRACK_SOURCE entersourcelabel=sourcelabel}}<div class="form-group"><label class="w-100" for="lang-input">{{get_string "srclang" component}}</label><select id="lang-input" class="custom-select {{CSS.TRACK_LANG_INPUT}}"><optgroup label="{{get_string "languagesinstalled" component}}">{{#langsinstalled}}<option value="{{code}}" {{#default}}selected="selected"{{/default}}>{{lang}}</option>{{/langsinstalled}}</optgroup><optgroup label="{{get_string "languagesavailable" component}} ">{{#langsavailable}}<option value="{{code}}">{{lang}}</option>{{/langsavailable}}</optgroup></select></div><div class="form-group"><label class="w-100" for="track-input">{{get_string "label" component}}</label><input id="track-input" class="form-control {{CSS.TRACK_LABEL_INPUT}}" type="text"/></div><div class="form-check"><input type="checkbox" class="form-check-input {{CSS.TRACK_DEFAULT_SELECT}}"/><label class="form-check-label">{{get_string "default" component}}</label></div>{{renderPartial "form_components.add_component" context=this label=addcomponentlabel}}</div>'},HTML_MEDIA:{
VIDEO:'<div style=float:left;width:100%;max-width:100%><script src="https://vjs.zencdn.net/7.8.4/video.js"><\/script>&nbsp;<video class="video-js"{{#width}}width="{{../width}}" {{/width}}{{#height}}height="{{../height}}" {{/height}}{{#poster}}poster="{{../poster}}" {{/poster}}{{#showControls}}controls="true" {{/showControls}}{{#loop}}loop="true" {{/loop}}{{#muted}}muted="true" {{/muted}}{{#autoplay}}autoplay="true" {{/autoplay}}{{#title}}title="{{../title}}" {{/title}}>{{#sources}}<source src="{{source}}">{{/sources}}{{#tracks}}<track src="{{track}}" kind="{{kind}}" srclang="{{srclang}}" label="{{label}}" {{#defaultTrack}}default="true"{{/defaultTrack}}>{{/tracks}}{{#description}}{{../description}}{{/description}}</video>&nbsp</div>{{#questions}}<div id=media_question data-question= \'{{../questions}}\'</div> {{/questions}}{{#minute}} <div id=media_minute data-minute =\'{{../minute}}\' </div>{{/minute}} {{#second}} <div id=media_second data-second =\'{{../second}}\' </div> {{/second}}<script> src=\'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\'><\/script><script>var checkExist = setInterval(function() {var doc = document.getElementsByClassName("video-js")[0];if (videojs.getPlayer(doc.id).id_.length > 0) {execute();clearInterval(checkExist);}}, 100);function execute() {var box = document.querySelector(\'[style="max-width:400px;"]\');box.style["max-width"] = "75%";'+"var cls = document.getElementById('page-mod-page-view') || document.getElementById('page-mod-assign-view');cls = cls.className;var t = cls.split(' ').find(el => el.substring(0, 4) === 'cmid');cls = parseInt(t.substring(t.indexOf('-') + 1));var doc = document.getElementsByClassName(\"video-js\")[0];var myPlayer = videojs.getPlayer(doc.id);myPlayer.fluid(true);var title = doc.title;var furthestwatched = 0;var played = 0;var watched = new Boolean(false);myPlayer.ready(function() {var q= document.getElementById('media_question');if (q){this.on('timeupdate', addQuestion);this.on('seeked', function(){ myPlayer.pause(); addQuestion(); });function addQuestion() {var minutes = document.getElementById('media_minute');var seconds = document.getElementById('media_second');if(minutes){ minutes= parseInt(minutes.getAttribute('data-minute') || 0);}else{ minutes = 0;}if(seconds){ seconds = parseInt(seconds.getAttribute('data-second') || 0);}else{ seconds = 0;}seconds = (minutes * 60) + seconds;if (this.currentTime() > seconds && watched == false) {watched = new Boolean(true);myPlayer.pause();var player = this, options ={};options.content = 'In the  modal';options.label = 'the label';var width = Math.round(myPlayer.currentWidth() * 0.5) + \"px\";var height = Math.round(myPlayer.currentHeight() * 0.5) + \"px\";var newElement = document.createElement('div');var question = q.getAttribute('data-question');newElement.innerHTML = \"<form> <label style='font-size:3em;' for='response_text'>\" + question + \":</label><br><textarea style='border-radius:12px; width:\" + width + \"; height:\" + height + \"; font-size:2em;'id='response_text' name='response_text' rows='6' cols='50'></textarea><br><br><input type='submit'style='border-radius:8px; font-size:2.5em;'  value='Submit your response'></form>\";options.content = newElement;var ModalDialog = videojs.getComponent('ModalDialog');var myModal = new ModalDialog(player, options);player.addChild(myModal);myModal.open();myModal.on('modalclose', function() {myPlayer.play();});$('form').submit(function(event) {console.log(\"Form Submitted!\");var resp = $('textarea[name=response_text]').val();require(['core/ajax'],function(ajax) {ajax.call([{methodname: 'mod_page_submit_video_response',method: 'POST',args: {pageid: cls,videoid: title,videoresponse: resp},done: console.log(\"recorded video response.\"),fail: console.log(\"\"),}]);});myModal.close();event.preventDefault();});} else {}}}this.on('pause', function() {console.log('paused');if (myPlayer.played().length > played) {var thisstart = Math.round(myPlayer.played().start(played));var thisend = Math.round(myPlayer.played().end(played));if (thisstart == thisend) {return;}played++;furthestwatched = thisend;} else {var thisstart = furthestwatched;var thisend = Math.round(myPlayer.played().end(played - 1));if (thisstart == thisend) {return;}furthestwatched = thisend;}require(['core/ajax'],function(ajax) {ajax.call([{methodname: 'mod_page_view_video',method: 'POST',args: {pageid: cls,videoid: title,thisstart: thisstart,thisend: thisend},done: console.log('logged latest watch'),fail: console.log(''),}]);});})});}<\/script></div>",AUDIO:'&nbsp;<audio {{#showControls}}controls="true" {{/showControls}}{{#loop}}loop="true" {{/loop}}{{#muted}}muted="true" {{/muted}}{{#autoplay}}autoplay="true" {{/autoplay}}{{#title}}title="{{../title}}" {{/title}}>{{#sources}}<source src="{{source}}">{{/sources}}{{#tracks}}<track src="{{track}}" kind="{{kind}}" srclang="{{srclang}}" label="{{label}}" {{#defaultTrack}}default="true"{{/defaultTrack}}>{{/tracks}}{{#description}}{{../description}}{{/description}}</audio>&nbsp',LINK:'<a href="{{url}}" {{#width}}data-width="{{../width}}" {{/width}}{{#height}}data-height="{{../height}}"{{/height}}>{{#name}}{{../name}}{{/name}}{{^name}}{{../url}}{{/name}}</a>'}};r.namespace("M.atto_media").Button=r.Base.create("button",r.M.editor_atto.EditorPlugin,[],{initializer:function(){this.get("host").canShowFilepicker("media")&&(this.editor.delegate("dblclick",this._displayDialogue,"video",this),this.editor.delegate("click",this._handleClick,"video",this),this.addButton({icon:"e/insert_edit_video",callback:this._displayDialogue,tags:"video, audio",tagMatchRequiresAll:!1}))},_getContext:function(e){return r.merge({elementid:this.get("host").get("elementid"),component:t,langsinstalled:this.get("langs").installed,langsavailable:this.get("langs").available,helpStrings:this.get("help"),CSS:s},e)},_handleClick:function(e){var t=e.target,a=this.get("host").getSelectionFromNode(t);this.get("host").getSelection()!==a&&this.get("host"
).setSelection(a)},_displayDialogue:function(){!1!==this.get("host").getSelection()&&("renderPartial"in r.Handlebars.helpers||(!function i(a,e){r.each(e,function(e,t){a.push(t),"object"!=typeof e?r.Handlebars.registerPartial(a.join(".").toLowerCase(),e):i(a,e),a.pop()})}([],c),r.Handlebars.registerHelper("renderPartial",function(e,t){var a,i,n;return e?(a=r.Handlebars.partials[e],i=t.hash.context?r.clone(t.hash.context):{},delete(n=r.merge(i,t.hash)).context,a?new r.Handlebars.SafeString(r.Handlebars.compile(a)(n)):""):""})),this.getDialogue({headerContent:M.util.get_string("createmedia",t),focusAfterHide:!0,width:660,focusOnShowSelector:l.URL_INPUT}).set("bodyContent",this._getDialogueContent(this.get("host").getSelection())).show(),M.form.shortforms({formid:this.get("host").get("elementid")+"_atto_media_form"}))},_getDialogueContent:function(e){var t=r.Node.create(r.Handlebars.compile(c.ROOT)(this._getContext())),a=this.get("host").getSelectedNodes().filter("video,audio").shift(),i=!!a&&this._getMediumProperties(a);return this._attachEvents(this._applyMediumProperties(t,i),e)},_attachEvents:function(e,i){return e.delegate("click",function(e){e.preventDefault(),this._addMediaSourceComponent(e.currentTarget)},l.MEDIA_SOURCE+" .addcomponent",this),e.delegate("click",function(e){e.preventDefault(),this._addTrackComponent(e.currentTarget)},l.TRACK+" .addcomponent",this),e.delegate("click",function(e){var t,a=e.currentTarget;a.get("checked")&&(t=function(e){return this._getTrackTypeFromTabPane(e.ancestor(".tab-pane"))}.bind(this),a.ancestor(".root.tab-content").all(l.TRACK_DEFAULT_SELECT).each(function(e){e!==a&&t(a)===t(e)&&e.set("checked",!1)}))},l.TRACK_DEFAULT_SELECT,this),e.delegate("click",function(e){var t=e.currentTarget,a=(t.ancestor(l.POSTER_SOURCE)?"image":t.ancestor(l.TRACK_SOURCE)&&"subtitle")||"media";e.preventDefault(),this.get("host").showFilepicker(a,this._getFilepickerCallback(t,a),this)},".openmediabrowser",this),e.all(".nav-item").on("click",function(e){e.currentTarget.get("parentNode").all(".active").removeClass("active")}),e.one(".submit").on("click",function(e){e.preventDefault();var t=this._getMediaHTML(e.currentTarget.ancestor(".atto_form")),a=this.get("host");this.getDialogue({focusAfterHide:null}).hide(),t&&(a.setSelection(i),a.insertContentAtFocusPoint(t),this.markUpdated())},this),e},_applyMediumProperties:function(e,t){var n,o,a;return t&&(n=function(e,t){e.one(l.TRACK_SOURCE+" "+l.URL_INPUT).set("value",t.src),e.one(l.TRACK_LANG_INPUT).set("value",t.srclang),e.one(l.TRACK_LABEL_INPUT).set("value",t.label),e.one(l.TRACK_DEFAULT_SELECT).set("checked",t.defaultTrack)},(o=e.one(".root.tab-content > .tab-pane#"+this.get("host").get("elementid")+"_"+t.type.toLowerCase())).one(l.MEDIA_SOURCE+" "+l.URL_INPUT).set("value",t.sources[0]),r.Array.each(t.sources.slice(1),function(t){this._addMediaSourceComponent(o.one(l.MEDIA_SOURCE+" .addcomponent"),function(e){e.one(l.URL_INPUT).set("value",t)})},this),r.Object.each(t.tracks,function(e,t){var a=e.length?e:[{src:"",srclang:"",label:"",defaultTrack:!1}],i=l["TRACK_"+t.toUpperCase()+"_PANE"];n(o.one(i+" "+l.TRACK),a[0]),r.Array.each(a.slice(1),function(t){this._addTrackComponent(o.one(i+" "+l.TRACK+" .addcomponent"),function(e){n(e,t)})},this)},this),o.one(l.TITLE_INPUT).set("value",t.title),o.one(l.MEDIA_CONTROLS_TOGGLE).set("checked",t.controls),o.one(l.MEDIA_AUTOPLAY_TOGGLE).set("checked",t.autoplay),o.one(l.MEDIA_MUTE_TOGGLE).set("checked",t.muted),o.one(l.MEDIA_LOOP_TOGGLE).set("checked",t.loop),"video"===(a=this._getMediumTypeFromTabPane(o))&&(o.one(l.POSTER_SOURCE+" "+l.URL_INPUT).setAttribute("value",t.poster),o.one(l.WIDTH_INPUT).set("value",t.width),o.one(l.HEIGHT_INPUT).set("value",t.height),o.one(l.QUESTIONS).set("value",t.questions),o.one(l.MINUTE_INPUT).set("value",t.minute),o.one(l.SECOND_INPUT).set("value",t.second)),o.siblings(".active").removeClass("active"),e.all(".root.nav-tabs .nav-item a").removeClass("active"),o.addClass("active"),e.one(l[a.toUpperCase()+"_TAB"]+" a").addClass("active")),e},_getMediumProperties:function(e){var t=function(e,t){return e.hasAttribute(t)&&(e.getAttribute(t)||""===e.getAttribute(t))},a={subtitles:[],captions:[],descriptions:[],chapters:[],metadata:[]};return e.all("track").each(function(e){a[e.getAttribute("kind")].push({src:e.getAttribute("src"),srclang:e.getAttribute("srclang"),label:e.getAttribute("label"),defaultTrack:t(e,"default")})}),{type:e.test("video")?i.VIDEO:i.AUDIO,sources:e.all("source").get("src"),poster:e.getAttribute("poster"),title:e.getAttribute("title"),width:e.getAttribute("width"),height:e.getAttribute("height"),questions:e.getAttribute("questions"),minute:e.getAttribute("minute"),second:e.getAttribute("second"),autoplay:t(e,"autoplay"),loop:t(e,"loop"),muted:t(e,"muted"),controls:t(e,"controls"),tracks:a}},_addTrackComponent:function(e,t){var a=this._getTrackTypeFromTabPane(e.ancestor(".tab-pane")),i=this._getContext({sourcelabel:a+"sourcelabel",addcomponentlabel:"add"+a+"track"});this._addComponent(e,c.FORM_COMPONENTS.TRACK,l.TRACK,i,t)},_addMediaSourceComponent:function(e,t){var a=this._getMediumTypeFromTabPane(e.ancestor(".tab-pane")),i=this._getContext({multisource:!0,id:s.MEDIA_SOURCE,entersourcelabel:a+"sourcelabel",addcomponentlabel:"addsource",addsourcehelp:this.get("help").addsource});this._addComponent(e,c.FORM_COMPONENTS.SOURCE,l.MEDIA_SOURCE,i,t)},_addComponent:function(e,t,a,i,n){var o,s=e.ancestor(a),l=r.Node.create(r.Handlebars.compile(t)(i)),d=this._getContext(i);d.label="remove",(o=r.Node.create(r.Handlebars.compile(c.FORM_COMPONENTS.REMOVE_COMPONENT)(d))).one(".removecomponent").on("click",function(e){e.preventDefault(),s.remove(!0)}),s.insert(l,"after"),e.ancestor().insert(o,"after"),e.ancestor().remove(!0),n&&n.call(this,l)},_getFilepickerCallback:function(n,o){return function(e){var t,a,i;""!==e.url&&(t=n.ancestor(".tab-pane"),n.ancestor(l.SOURCE).one(l.URL_INPUT).set("value",e.url),t.get("id")===this.get("host").get("elementid"
)+"_"+s.LINK&&t.one(l.NAME_INPUT).set("value",e.file),"subtitle"===o&&(a=e.file.split(".vtt")[0].split("-").slice(-1)[0],(i=this.get("langs").available.reduce(function(e,t){return t.code===a?t:e},!1))&&(n.ancestor(l.TRACK).one(l.TRACK_LABEL_INPUT).set("value",i.lang.substr(0,i.lang.lastIndexOf(" "))),n.ancestor(l.TRACK).one(l.TRACK_LANG_INPUT).set("value",i.code))))}},_getMediumTypeFromTabPane:function(e){return e.getAttribute("data-medium-type")},_getTrackTypeFromTabPane:function(e){return e.getAttribute("data-track-kind")},_getMediaHTML:function(e){var t=this._getMediumTypeFromTabPane(e.one(".root.tab-content > .tab-pane.active")),a=e.one(l[t.toUpperCase()+"_PANE"]);return this["_getMediaHTML"+t[0].toUpperCase()+t.substr(1)](a)},_getMediaHTMLLink:function(e){var t={url:e.one(l.URL_INPUT).get("value"),name:e.one(l.NAME_INPUT).get("value")||!1};return t.url?r.Handlebars.compile(c.HTML_MEDIA.LINK)(t):""},_getMediaHTMLVideo:function(e){var t=this._getContextForMediaHTML(e);return t.width=e.one(l.WIDTH_INPUT).get("value")||!1,t.height=e.one(l.HEIGHT_INPUT).get("value")||!1,t.poster=e.one(l.POSTER_SOURCE+" "+l.URL_INPUT).get("value")||!1,t.minute=e.one(l.MINUTE_INPUT).get("value")||!1,t.second=e.one(l.SECOND_INPUT).get("value")||!1,t.questions=e.one(l.QUESTIONS).get("value")||!1,t.sources.length?r.Handlebars.compile(c.HTML_MEDIA.VIDEO)(t):""},_getMediaHTMLAudio:function(e){var t=this._getContextForMediaHTML(e);return t.sources.length?r.Handlebars.compile(c.HTML_MEDIA.AUDIO)(t):""},_getContextForMediaHTML:function(e){var t=[];return e.all(l.TRACK).each(function(e){t.push({track:e.one(l.TRACK_SOURCE+" "+l.URL_INPUT).get("value"),kind:this._getTrackTypeFromTabPane(e.ancestor(".tab-pane")),label:e.one(l.TRACK_LABEL_INPUT).get("value")||e.one(l.TRACK_LANG_INPUT).get("value"),srclang:e.one(l.TRACK_LANG_INPUT).get("value"),defaultTrack:e.one(l.TRACK_DEFAULT_SELECT).get("checked")?"true":null})},this),{sources:e.all(l.MEDIA_SOURCE+" "+l.URL_INPUT).get("value").filter(function(e){return!!e}).map(function(e){return{source:e}}),description:e.one(l.MEDIA_SOURCE+" "+l.URL_INPUT).get("value")||!1,tracks:t.filter(function(e){return!!e.track}),showControls:e.one(l.MEDIA_CONTROLS_TOGGLE).get("checked"),autoplay:e.one(l.MEDIA_AUTOPLAY_TOGGLE).get("checked"),muted:e.one(l.MEDIA_MUTE_TOGGLE).get("checked"),loop:e.one(l.MEDIA_LOOP_TOGGLE).get("checked"),title:e.one(l.TITLE_INPUT).get("value")||!1}}},{ATTRS:{langs:{},help:{}}})},"@VERSION@",{requires:["moodle-editor_atto-plugin","moodle-form-shortforms"]});