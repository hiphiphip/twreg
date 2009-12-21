if(typeof twreg_widget_url=='undefined'){
    var twreg_widget_url = 'http://twreg.info/widget.php?widget=true';
}else if(twreg_widget_url==''){
    twreg_widget_url= 'http://twreg.info/widget.php?widget=true';
}
document.write('<img id="twregwidget_btn" src="http://farm3.static.flickr.com/2560/4194690716_a680dfca13_o.png" style="cursor:pointer;" />');
document.getElementById('twregwidget_btn').onclick = function(){
    var csstext = '';
    var twregwidget_mask=document.createElement("div");
    twregwidget_mask.id="twregwidget_mask";
    csstext = "background-color: #fff; opacity:0.6; filter:alpha(opacity=60); position: absolute; top: 0; left: 0; z-index: 10000;";
    if(!+"\v1"){
        twregwidget_mask.style.setAttribute('cssText', csstext);
    }else{
        twregwidget_mask.setAttribute('style', csstext);
    }
    if(document.documentElement.clientHeight>document.body.clientHeight){
        twregwidget_mask.style.height = document.documentElement.clientHeight + 'px';
    }else{
        twregwidget_mask.style.height = document.body.clientHeight + 'px';
    }
    twregwidget_mask.style.width = document.documentElement.clientWidth + 'px';
    document.body.insertBefore(twregwidget_mask, document.body.firstChild);
    var twregwidget_container = document.createElement("div");
    twregwidget_container.id="twregwidget_container";
    csstext = "position: absolute; top: 50%; left: 50%; margin:-235px 0 0 -235px; height:470px; width:470px; overflow:hidden; z-index: 10001;";
    if(!+"\v1"){
        twregwidget_container.style.setAttribute('cssText', csstext);
    }else{
        twregwidget_container.setAttribute('style', csstext);
    }
    twregwidget_container.innerHTML = '<a href="#" id="twregwidget_close">× Close Widget</a><iframe src="'+twreg_widget_url+'" frameborder=no allowTransparency="true" scrolling=no height=470 width=470></ifarme>'
    document.body.appendChild(twregwidget_container);
    csstext = "text-align:right; display:inline; font-size:12px; font-family:arial; font-weight:bold; position:absolute; top:10px; right:10px; background-color:#f3f3f3 !important; border:none !important; padding:5px; color:#900; text-decoration:none;";
    if(!+"\v1"){
        document.getElementById('twregwidget_close').style.setAttribute('cssText', csstext);
    }else{
        document.getElementById('twregwidget_close').setAttribute('style', csstext);
    }
    document.getElementById('twregwidget_close').onclick = function(){
        document.body.removeChild(document.getElementById('twregwidget_container'));
        document.body.removeChild(document.getElementById('twregwidget_mask'));
        return false;
    }
}