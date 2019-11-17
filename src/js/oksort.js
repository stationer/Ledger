/* Copyright (c) 2006-2019 Tyler Uebele * Released under the MIT license. * latest at https://github.com/stationer/sSortTable/ * minified by Google Closure Compiler */
function sortTable(a,b,c){sortTable.sortCol=-1;var d=a.className.match(/js-sort-\d+/);null!=d&&(sortTable.sortCol=d[0].replace(/js-sort-/,""),a.className=a.className.replace(new RegExp(" ?"+d[0]+"\\b"),""));"undefined"===typeof b&&(b=sortTable.sortCol);"undefined"!==typeof c?sortTable.sortDir=-1==c||"desc"==c?-1:1:(d=a.className.match(/js-sort-(a|de)sc/),sortTable.sortDir=null!=d&&sortTable.sortCol==b?"js-sort-asc"==d[0]?-1:1:1);a.className=a.className.replace(/ ?js-sort-(a|de)sc/g,"");a.className+=
" js-sort-"+b;sortTable.sortCol=b;a.className+=" js-sort-"+(-1==sortTable.sortDir?"desc":"asc");b<a.tHead.rows[a.tHead.rows.length-1].cells.length&&(d=a.tHead.rows[a.tHead.rows.length-1].cells[b].className.match(/js-sort-[-\w]+/));for(c=0;c<a.tHead.rows[a.tHead.rows.length-1].cells.length;c++)b==a.tHead.rows[a.tHead.rows.length-1].cells[c].getAttribute("data-js-sort-colNum")&&(d=a.tHead.rows[a.tHead.rows.length-1].cells[c].className.match(/js-sort-[-\w]+/));sortTable.sortFunc=null!=d?d[0].replace(/js-sort-/,
""):"string";a.querySelectorAll(".js-sort-active").forEach(function(a){a.className=a.className.replace(/ ?js-sort-active\b/,"")});a.querySelectorAll('[data-js-sort-colNum="'+b+'"]:not(:empty)').forEach(function(a){a.className+=" js-sort-active"});b=[];a=a.tBodies[0];for(c=0;c<a.rows.length;c++)b[c]=a.rows[c];for("none"!=sortTable.sortFunc&&b.sort(sortTable.compareRow);a.firstChild;)a.removeChild(a.firstChild);for(c=0;c<b.length;c++)a.appendChild(b[c])}
sortTable.compareRow=function(a,b){"function"!=typeof sortTable[sortTable.sortFunc]&&(sortTable.sortFunc="string");a=sortTable[sortTable.sortFunc](a.cells[sortTable.sortCol]);b=sortTable[sortTable.sortFunc](b.cells[sortTable.sortCol]);return a==b?0:sortTable.sortDir*(a>b?1:-1)};sortTable.stripTags=function(a){return a.replace(/<\/?[a-z][a-z0-9]*\b[^>]*>/gi,"")};
sortTable.date=function(a){if(okDate){var b=okDate(sortTable.stripTags(a.innerHTML));return b?b.getTime():0}return(new b(sortTable.stripTags(a.innerHTML))).getTime()||0};sortTable.number=function(a){return Number(sortTable.stripTags(a.innerHTML).replace(/[^-\d.]/g,""))};sortTable.string=function(a){return sortTable.stripTags(a.innerHTML).toLowerCase()};sortTable.raw=function(a){return a.innerHTML};sortTable.last=function(a){return sortTable.stripTags(a.innerHTML).split(" ").pop().toLowerCase()};
sortTable.input=function(a){for(var b=0;b<a.children.length;b++)if("object"==typeof a.children[b]&&"undefined"!=typeof a.children[b].value)return a.children[b].value.toLowerCase();return sortTable.string(a)};sortTable.none=function(a){return null};sortTable.getClickHandler=function(a,b){return function(){sortTable(a,b)}};
sortTable.init=function(){var a=document.querySelectorAll?document.querySelectorAll("table.js-sort-table"):document.getElementsByTagName("table");for(var b=0;b<a.length;b++)if((document.querySelectorAll||null!==a[b].className.match(/\bjs-sort-table\b/))&&!a[b].attributes["data-js-sort-table"]){if(a[b].tHead)var c=a[b].tHead;else c=document.createElement("thead"),c.appendChild(a[b].rows[0]),a[b].insertBefore(c,a[b].children[0]);for(var d=0;d<c.rows.length;d++)for(var e=0,f=0;e<c.rows[d].cells.length;e++){c.rows[d].cells[e].setAttribute("data-js-sort-colNum",
f);var g=sortTable.getClickHandler(a[b],f);window.addEventListener?c.rows[d].cells[e].addEventListener("click",g):window.attachEvent&&c.rows[d].cells[e].attachEvent("onclick",g);f+=c.rows[d].cells[e].colSpan}a[b].setAttribute("data-js-sort-table","true")}c=document.createElement("style");document.head.insertBefore(c,document.head.childNodes[0]);c=c.sheet;c.insertRule('table.js-sort-asc thead tr > .js-sort-active:not(.js-sort-none):after {content: "\\25b2";font-size: 0.7em;padding-left: 3px;line-height: 0.7em;}',
0);c.insertRule('table.js-sort-desc thead tr > .js-sort-active:not(.js-sort-none):after {content: "\\25bc";font-size: 0.7em;padding-left: 3px;line-height: 0.7em;}',0)};window.addEventListener?window.addEventListener("load",sortTable.init,!1):window.attachEvent&&window.attachEvent("onload",sortTable.init);"function"!==typeof NodeList.prototype.forEach&&(NodeList.prototype.forEach=Array.prototype.forEach);
