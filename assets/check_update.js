 var container=document.getElementById("sapphire-check-update");
if(container){
    var ajax = new XMLHttpRequest();
    ajax.open('get','https://www.mochengli.cn/sapphire');
    ajax.send();
    container.innerHTML=`<h3>正在检测主题是否有更新……</h3>`;
    ajax.onreadystatechange = function () {
        if (ajax.readyState==4 &&ajax.status==200) {
            var obj=JSON.parse(ajax.responseText);
            var newest=parseFloat(obj.ver);
            if(newest>sapphire_ver){
                container.innerHTML=`<h3>哇！主题有新的发布版~</h3>
                <p>您现在的版本：`+sapphire_ver+`</p>
                <p>GitHub 最新发布版：`+obj.ver+`，下载地址：<a href="`+obj.url+`">点击下载</a></p>`;
            }else{
                container.innerHTML=`<h3>真棒！您现在使用的是最新版主题：`+obj.ver+`。</h3>`;
            }
        }
    }
}