!function(t){"function"==typeof define&&define.amd?define(["jquery","datatables.net","datatables.net-buttons"],function(e){return t(e,window,document)}):"object"==typeof exports?module.exports=function(e,o,l,n){return e||(e=window),o&&o.fn.dataTable||(o=require("datatables.net")(e,o).$),o.fn.dataTable.Buttons||require("datatables.net-buttons")(e,o),t(o,e,e.document,l,n)}:t(jQuery,window,document)}(function(t,e,o,l,n,r){"use strict";function a(){return l||e.JSZip}function d(){return n||e.pdfMake}function p(t){for(var e="A".charCodeAt(0),o="Z".charCodeAt(0),l=o-e+1,n="";t>=0;)n=String.fromCharCode(t%l+e)+n,t=Math.floor(t/l)-1;return n}function i(e,o){h===r&&(h=-1===g.serializeToString(t.parseXML(v["xl/worksheets/sheet1.xml"])).indexOf("xmlns:r")),t.each(o,function(o,l){if(t.isPlainObject(l)){i(e.folder(o),l)}else{if(h){var n,r,a=l.childNodes[0],d=[];for(n=a.attributes.length-1;n>=0;n--){var p=a.attributes[n].nodeName,f=a.attributes[n].nodeValue;-1!==p.indexOf(":")&&(d.push({name:p,value:f}),a.removeAttribute(p))}for(n=0,r=d.length;n<r;n++){var m=l.createAttribute(d[n].name.replace(":","_dt_b_namespace_token_"));m.value=d[n].value,a.setAttributeNode(m)}}var s=g.serializeToString(l);h&&(-1===s.indexOf("<?xml")&&(s='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'+s),s=s.replace(/_dt_b_namespace_token_/g,":")),s=s.replace(/<(.*?) xmlns=""(.*?)>/g,"<$1 $2>"),e.file(o,s)}})}function f(e,o,l){var n=e.createElement(o);return l&&(l.attr&&t(n).attr(l.attr),l.children&&t.each(l.children,function(t,e){n.appendChild(e)}),l.text&&n.appendChild(e.createTextNode(l.text))),n}function m(t,e){var o,l,n,r=t.header[e].length;t.footer&&t.footer[e].length>r&&(r=t.footer[e].length);for(var a=0,d=t.body.length;a<d&&(n=t.body[a][e].toString(),-1!==n.indexOf("\n")?(l=n.split("\n"),l.sort(function(t,e){return e.length-t.length}),o=l[0].length):o=n.length,o>r&&(r=o),!(r>40));a++);return r*=1.3,r>6?r:6}var s=t.fn.dataTable,y=function(t){if(!(void 0===t||"undefined"!=typeof navigator&&/MSIE [1-9]\./.test(navigator.userAgent))){var e=t.document,o=function(){return t.URL||t.webkitURL||t},l=e.createElementNS("http://www.w3.org/1999/xhtml","a"),n="download"in l,a=function(t){var e=new MouseEvent("click");t.dispatchEvent(e)},d=/constructor/i.test(t.HTMLElement)||t.safari,p=/CriOS\/[\d]+/.test(navigator.userAgent),i=function(e){(t.setImmediate||t.setTimeout)(function(){throw e},0)},f=function(t){var e=function(){"string"==typeof t?o().revokeObjectURL(t):t.remove()};setTimeout(e,4e4)},m=function(t,e,o){e=[].concat(e);for(var l=e.length;l--;){var n=t["on"+e[l]];if("function"==typeof n)try{n.call(t,o||t)}catch(t){i(t)}}},s=function(t){return/^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(t.type)?new Blob([String.fromCharCode(65279),t],{type:t.type}):t},y=function(e,i,y){y||(e=s(e));var u,c=this,I=e.type,F="application/octet-stream"===I,x=function(){m(c,"writestart progress write writeend".split(" "))};if(c.readyState=c.INIT,n)return u=o().createObjectURL(e),void setTimeout(function(){l.href=u,l.download=i,a(l),x(),f(u),c.readyState=c.DONE});!function(){if((p||F&&d)&&t.FileReader){var l=new FileReader;return l.onloadend=function(){var e=p?l.result:l.result.replace(/^data:[^;]*;/,"data:attachment/file;");t.open(e,"_blank")||(t.location.href=e),e=r,c.readyState=c.DONE,x()},l.readAsDataURL(e),void(c.readyState=c.INIT)}if(u||(u=o().createObjectURL(e)),F)t.location.href=u;else{t.open(u,"_blank")||(t.location.href=u)}c.readyState=c.DONE,x(),f(u)}()},u=y.prototype,c=function(t,e,o){return new y(t,e||t.name||"download",o)};return"undefined"!=typeof navigator&&navigator.msSaveOrOpenBlob?function(t,e,o){return e=e||t.name||"download",o||(t=s(t)),navigator.msSaveOrOpenBlob(t,e)}:(u.abort=function(){},u.readyState=u.INIT=0,u.WRITING=1,u.DONE=2,u.error=u.onwritestart=u.onprogress=u.onwrite=u.onabort=u.onerror=u.onwriteend=null,c)}}("undefined"!=typeof self&&self||void 0!==e&&e||this.content);s.fileSave=y;var u=function(e,o){var l="*"===e.filename&&"*"!==e.title&&e.title!==r?e.title:e.filename;return"function"==typeof l&&(l=l()),-1!==l.indexOf("*")&&(l=t.trim(l.replace("*",t("title").text()))),l=l.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g,""),o===r||!0===o?l+e.extension:l},c=function(t){var e="Sheet1";return t.sheetName&&(e=t.sheetName.replace(/[\[\]\*\/\\\?\:]/g,"")),e},I=function(e){var o=e.title;return"function"==typeof o&&(o=o()),-1!==o.indexOf("*")?o.replace("*",t("title").text()||"Exported data"):o},F=function(t){return t.newline?t.newline:navigator.userAgent.match(/Windows/)?"\r\n":"\n"},x=function(t,e){for(var o=F(e),l=t.buttons.exportData(e.exportOptions),n=e.fieldBoundary,a=e.fieldSeparator,d=new RegExp(n,"g"),p=e.escapeChar!==r?e.escapeChar:"\\",i=function(t){for(var e="",o=0,l=t.length;o<l;o++)o>0&&(e+=a),e+=n?n+(""+t[o]).replace(d,p+n)+n:t[o];return e},f=e.header?i(l.header)+o:"",m=e.footer&&l.footer?o+i(l.footer):"",s=[],y=0,u=l.body.length;y<u;y++)s.push(i(l.body[y]));return{str:f+s.join(o)+m,rows:s.length}},b=function(){if(-1===navigator.userAgent.indexOf("Safari")||-1!==navigator.userAgent.indexOf("Chrome")||-1!==navigator.userAgent.indexOf("Opera"))return!1;var t=navigator.userAgent.match(/AppleWebKit\/(\d+\.\d+)/);return!!(t&&t.length>1&&1*t[1]<603.1)};try{var h,g=new XMLSerializer}catch(t){}var v={"_rels/.rels":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/></Relationships>',"xl/_rels/workbook.xml.rels":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/><Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/></Relationships>',"[Content_Types].xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="xml" ContentType="application/xml" /><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml" /><Default Extension="jpeg" ContentType="image/jpeg" /><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml" /><Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml" /><Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml" /></Types>',"xl/workbook.xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><fileVersion appName="xl" lastEdited="5" lowestEdited="5" rupBuild="24816"/><workbookPr showInkAnnotation="0" autoCompressPictures="0"/><bookViews><workbookView xWindow="0" yWindow="0" windowWidth="25600" windowHeight="19020" tabRatio="500"/></bookViews><sheets><sheet name="" sheetId="1" r:id="rId1"/></sheets></workbook>',"xl/worksheets/sheet1.xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac"><sheetData/></worksheet>',"xl/styles.xml":'<?xml version="1.0" encoding="UTF-8"?><styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac"><numFmts count="6"><numFmt numFmtId="164" formatCode="#,##0.00_- [$$-45C]"/><numFmt numFmtId="165" formatCode="&quot;£&quot;#,##0.00"/><numFmt numFmtId="166" formatCode="[$€-2] #,##0.00"/><numFmt numFmtId="167" formatCode="0.0%"/><numFmt numFmtId="168" formatCode="#,##0;(#,##0)"/><numFmt numFmtId="169" formatCode="#,##0.00;(#,##0.00)"/></numFmts><fonts count="5" x14ac:knownFonts="1"><font><sz val="11" /><name val="Calibri" /></font><font><sz val="11" /><name val="Calibri" /><color rgb="FFFFFFFF" /></font><font><sz val="11" /><name val="Calibri" /><b /></font><font><sz val="11" /><name val="Calibri" /><i /></font><font><sz val="11" /><name val="Calibri" /><u /></font></fonts><fills count="6"><fill><patternFill patternType="none" /></fill><fill/><fill><patternFill patternType="solid"><fgColor rgb="FFD9D9D9" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="FFD99795" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="ffc6efce" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="ffc6cfef" /><bgColor indexed="64" /></patternFill></fill></fills><borders count="2"><border><left /><right /><top /><bottom /><diagonal /></border><border diagonalUp="false" diagonalDown="false"><left style="thin"><color auto="1" /></left><right style="thin"><color auto="1" /></right><top style="thin"><color auto="1" /></top><bottom style="thin"><color auto="1" /></bottom><diagonal /></border></borders><cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" /></cellStyleXfs><cellXfs count="67"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="left"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="center"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="right"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="fill"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment textRotation="90"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment wrapText="1"/></xf><xf numFmtId="9"   fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="164" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="165" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="166" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="167" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="168" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="169" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="3" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="4" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="1" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="2" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/></cellXfs><cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0" /></cellStyles><dxfs count="0" /><tableStyles count="0" defaultTableStyle="TableStyleMedium9" defaultPivotStyle="PivotStyleMedium4" /></styleSheet>'},w=[{match:/^\-?\d+\.\d%$/,style:60,fmt:function(t){return t/100}},{match:/^\-?\d+\.?\d*%$/,style:56,fmt:function(t){return t/100}},{match:/^\-?\$[\d,]+.?\d*$/,style:57},{match:/^\-?£[\d,]+.?\d*$/,style:58},{match:/^\-?€[\d,]+.?\d*$/,style:59},{match:/^\-?\d+$/,style:65},{match:/^\-?\d+\.\d{2}$/,style:66},{match:/^\([\d,]+\)$/,style:61,fmt:function(t){return-1*t.replace(/[\(\)]/g,"")}},{match:/^\([\d,]+\.\d{2}\)$/,style:62,fmt:function(t){return-1*t.replace(/[\(\)]/g,"")}},{match:/^\-?[\d,]+$/,style:63},{match:/^\-?[\d,]+\.\d{2}$/,style:64}];return s.ext.buttons.copyHtml5={className:"buttons-copy buttons-html5",text:function(t){return t.i18n("buttons.copy","Copy")},action:function(e,l,n,r){var a=x(l,r),d=a.str,p=t("<div/>").css({height:1,width:1,overflow:"hidden",position:"fixed",top:0,left:0});r.customize&&(d=r.customize(d,r));var i=t("<textarea readonly/>").val(d).appendTo(p);if(o.queryCommandSupported("copy")){p.appendTo(l.table().container()),i[0].focus(),i[0].select();try{var f=o.execCommand("copy");if(p.remove(),f)return void l.buttons.info(l.i18n("buttons.copyTitle","Copy to clipboard"),l.i18n("buttons.copySuccess",{1:"Copied one row to clipboard",_:"Copied %d rows to clipboard"},a.rows),2e3)}catch(t){}}var m=t("<span>"+l.i18n("buttons.copyKeys","Press <i>ctrl</i> or <i>⌘</i> + <i>C</i> to copy the table data<br>to your system clipboard.<br><br>To cancel, click this message or press escape.")+"</span>").append(p);l.buttons.info(l.i18n("buttons.copyTitle","Copy to clipboard"),m,0),i[0].focus(),i[0].select();var s=t(m).closest(".dt-button-info"),y=function(){s.off("click.buttons-copy"),t(o).off(".buttons-copy"),l.buttons.info(!1)};s.on("click.buttons-copy",y),t(o).on("keydown.buttons-copy",function(t){27===t.keyCode&&y()}).on("copy.buttons-copy cut.buttons-copy",function(){y()})},exportOptions:{},fieldSeparator:"\t",fieldBoundary:"",header:!0,footer:!1},s.ext.buttons.csvHtml5={bom:!1,className:"buttons-csv buttons-html5",available:function(){return e.FileReader!==r&&e.Blob},text:function(t){return t.i18n("buttons.csv","CSV")},action:function(t,e,l,n){var r=x(e,n).str,a=n.charset;n.customize&&(r=n.customize(r,n)),!1!==a?(a||(a=o.characterSet||o.charset),a&&(a=";charset="+a)):a="",n.bom&&(r="\ufeff"+r),y(new Blob([r],{type:"text/csv"+a}),u(n),!0)},filename:"*",extension:".csv",exportOptions:{},fieldSeparator:",",fieldBoundary:'"',escapeChar:'"',charset:null,header:!0,footer:!1},s.ext.buttons.excelHtml5={className:"buttons-excel buttons-html5",available:function(){return e.FileReader!==r&&a()!==r&&!b()&&g},text:function(t){return t.i18n("buttons.excel","Excel")},action:function(e,o,l,n){var d,s,I=0,F=function(e){var o=v[e];return t.parseXML(o)},x=F("xl/worksheets/sheet1.xml"),b=x.getElementsByTagName("sheetData")[0],h={_rels:{".rels":F("_rels/.rels")},xl:{_rels:{"workbook.xml.rels":F("xl/_rels/workbook.xml.rels")},"workbook.xml":F("xl/workbook.xml"),"styles.xml":F("xl/styles.xml"),worksheets:{"sheet1.xml":x}},"[Content_Types].xml":F("[Content_Types].xml")},g=o.buttons.exportData(n.exportOptions),B=function(e){d=I+1,s=f(x,"row",{attr:{r:d}});for(var o=0,l=e.length;o<l;o++){var n=p(o)+""+d,a=null;if(null!==e[o]&&e[o]!==r&&""!==e[o]){e[o]=t.trim(e[o]);for(var i=0,m=w.length;i<m;i++){var y=w[i];if(e[o].match&&e[o].match(y.match)){var u=e[o].replace(/[^\d\.\-]/g,"");y.fmt&&(u=y.fmt(u)),a=f(x,"c",{attr:{r:n,s:y.style},children:[f(x,"v",{text:u})]});break}}if(!a)if("number"==typeof e[o]||e[o].match&&e[o].match(/^-?\d+(\.\d+)?$/)&&!e[o].match(/^0\d+/))a=f(x,"c",{attr:{t:"n",r:n},children:[f(x,"v",{text:e[o]})]});else{var c=e[o].replace?e[o].replace(/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F-\x9F]/g,""):e[o];a=f(x,"c",{attr:{t:"inlineStr",r:n},children:{row:f(x,"is",{children:{row:f(x,"t",{text:c})}})}})}s.appendChild(a)}}b.appendChild(s),I++};t("sheets sheet",h.xl["workbook.xml"]).attr("name",c(n)),n.customizeData&&n.customizeData(g),n.header&&(B(g.header),t("row c",x).attr("s","2"));for(var k=0,C=g.body.length;k<C;k++)B(g.body[k]);n.footer&&g.footer&&(B(g.footer),t("row:last c",x).attr("s","2"));var T=f(x,"cols");t("worksheet",x).prepend(T);for(var S=0,N=g.header.length;S<N;S++)T.appendChild(f(x,"col",{attr:{min:S+1,max:S+1,width:m(g,S),customWidth:1}}));n.customize&&n.customize(h);var O=a(),z=new O,A={type:"blob",mimeType:"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"};i(z,h),z.generateAsync?z.generateAsync(A).then(function(t){y(t,u(n))}):y(z.generate(A),u(n))},filename:"*",extension:".xlsx",exportOptions:{},header:!0,footer:!1},s.ext.buttons.pdfHtml5={className:"buttons-pdf buttons-html5",available:function(){return e.FileReader!==r&&d()},text:function(t){return t.i18n("buttons.pdf","PDF")},action:function(e,o,l,n){var r=(F(n),o.buttons.exportData(n.exportOptions)),a=[];n.header&&a.push(t.map(r.header,function(t){return{text:"string"==typeof t?t:t+"",style:"tableHeader"}}));for(var p=0,i=r.body.length;p<i;p++)a.push(t.map(r.body[p],function(t){return{text:"string"==typeof t?t:t+"",style:p%2?"tableBodyEven":"tableBodyOdd"}}));n.footer&&r.footer&&a.push(t.map(r.footer,function(t){return{text:"string"==typeof t?t:t+"",style:"tableFooter"}}));var f={pageSize:n.pageSize,pageOrientation:n.orientation,content:[{table:{headerRows:1,body:a},layout:"noBorders"}],styles:{tableHeader:{bold:!0,fontSize:11,color:"white",fillColor:"#2d4154",alignment:"center"},tableBodyEven:{},tableBodyOdd:{fillColor:"#f3f3f3"},tableFooter:{bold:!0,fontSize:11,color:"white",fillColor:"#2d4154"},title:{alignment:"center",fontSize:15},message:{}},defaultStyle:{fontSize:10}};n.message&&f.content.unshift({text:"function"==typeof n.message?n.message(o,l,n):n.message,style:"message",margin:[0,0,0,12]}),n.title&&f.content.unshift({text:I(n),style:"title",margin:[0,0,0,12]}),n.customize&&n.customize(f,n);var m=d().createPdf(f);"open"!==n.download||b()?m.getBuffer(function(t){var e=new Blob([t],{type:"application/pdf"});y(e,u(n))}):m.open()},title:"*",filename:"*",extension:".pdf",exportOptions:{},orientation:"portrait",pageSize:"A4",header:!0,footer:!1,message:null,customize:null,download:"download"},s.Buttons});