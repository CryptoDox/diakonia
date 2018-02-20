/**
 * instant.js 1.5 (17-Mar-2008)
 * (c) by Christian Effenberger 
 * All Rights Reserved
 * Source: instant.netzgesta.de
 * Distributed under Netzgestade Software License Agreement
 * http://www.netzgesta.de/cvi/LICENSE.txt
 * License permits free of charge
 * use on non-commercial and 
 * private web sites only 
**/

var tmp = navigator.appName == 'Microsoft Internet Explorer' && navigator.userAgent.indexOf('Opera') < 1 ? 1 : 0;
if(tmp) var isIE = document.namespaces ? 1 : 0;

if(isIE) {
	if(document.namespaces['v'] == null) {
		var stl = document.createStyleSheet();
		stl.addRule("v\\:*", "behavior: url(#default#VML);"); 
		document.namespaces.add("v", "urn:schemas-microsoft-com:vml"); 
	}
}

function getImages(className){
	var children = document.getElementsByTagName('img'); 
	var elements = new Array(); var i = 0;
	var child; var classNames; var j = 0;
	for (i=0;i<children.length;i++) {
		child = children[i];
		classNames = child.className.split(' ');
		for (var j = 0; j < classNames.length; j++) {
			if (classNames[j] == className) {
				elements.push(child);
				break;
			}
		}
	}
	return elements;
}
function getClasses(classes,string){
	var temp = '';
	for (var j=0;j<classes.length;j++) {
		if (classes[j] != string) {
			if (temp) {
				temp += ' '
			}
			temp += classes[j];
		}
	}
	return temp;
}
function getClassValue(classes,string){
	var temp = 0; var pos = string.length;
	for (var j=0;j<classes.length;j++) {
		if (classes[j].indexOf(string) == 0) {
			temp = Math.min(classes[j].substring(pos),100);
			break;
		}
	}
	return Math.max(0,temp);
}
function getClassColor(classes,string){
	var temp = 0; var str = ''; var pos = string.length;
	for (var j=0;j<classes.length;j++) {
		if (classes[j].indexOf(string) == 0) {
			temp = classes[j].substring(pos);
			str = '#' + temp.toLowerCase();
			break;
		}
	}
	if(str.match(/^#[0-9a-f][0-9a-f][0-9a-f][0-9a-f][0-9a-f][0-9a-f]$/i)) {
		return str;
	}else {
		return 0;
	}
}
function getClassAttribute(classes,string){
	var temp = 0; var pos = string.length;
	for (var j=0;j<classes.length;j++) {
		if (classes[j].indexOf(string) == 0) {
			temp = 1; 
			break;
		}
	}
	return temp;
}
function addShading(ctx,x,y,width,height,opacity) {
	var style = ctx.createLinearGradient(0,y,0,y+height);
	style.addColorStop(0,'rgba(0,0,0,'+(opacity/2)+')');
	style.addColorStop(0.3,'rgba(0,0,0,0)');
	style.addColorStop(0.7,'rgba(254,254,254,0)');
	style.addColorStop(1,'rgba(254,254,254,'+(opacity)+')');
	ctx.beginPath(); ctx.rect(x,y,width,height);
	ctx.closePath(); ctx.fillStyle = style; ctx.fill();
}
function addLining(ctx,x,y,width,height,opacity,inset,inner,color) {
	var style = ctx.createLinearGradient(x,y,width,height);
	if(inner==true) {
		style.addColorStop(0,'rgba(192,192,192,'+opacity+')');
		style.addColorStop(0.7,'rgba(254,254,254,0.8)');
		style.addColorStop(1,'rgba(254,254,254,0.9)');
	}else {
		if(color=='#f0f4ff') {
			style.addColorStop(0,'rgba(254,254,254,0.9)');
			style.addColorStop(0.3,'rgba(254,254,254,0.8)');
			style.addColorStop(1,'rgba(192,192,192,0)');
		}else {
			style.addColorStop(0,'rgba(254,254,254,0)');
			style.addColorStop(1,'rgba(192,192,192,0)');
		}
	}
	ctx.strokeStyle = style; ctx.lineWidth = inset;
	ctx.beginPath(); ctx.rect(x,y,width,height);
	ctx.closePath(); ctx.stroke();
}
function addRadialStyle(ctx,x1,y1,r1,x2,y2,r2,opacity) {
	var tmp = ctx.createRadialGradient(x1,y1,r1,x2,y2,r2);
	var opt = Math.min(parseFloat(opacity+0.1),1.0);
	tmp.addColorStop(0,'rgba(0,0,0,'+opt+')');
	tmp.addColorStop(0.25,'rgba(0,0,0,'+opacity+')');
	tmp.addColorStop(1,'rgba(0,0,0,0)');
	return tmp;
}
function addLinearStyle(ctx,x,y,w,h,opacity) {
	var tmp = ctx.createLinearGradient(x,y,w,h);
	var opt = Math.min(parseFloat(opacity+0.1),1.0);
	tmp.addColorStop(0,'rgba(0,0,0,'+opt+')');
	tmp.addColorStop(0.25,'rgba(0,0,0,'+opacity+')');
	tmp.addColorStop(1,'rgba(0,0,0,0)');
	return tmp;
}
function tiltShadow(ctx,x,y,width,height,radius,opacity){
	var style; 
	ctx.beginPath(); ctx.rect(x,y+height-radius,radius,radius); ctx.closePath();
	style = addRadialStyle(ctx,x+radius,y+height-radius,radius-x,x+radius,y+height-radius,radius,opacity);
	ctx.fillStyle = style; ctx.fill();
	ctx.beginPath(); ctx.rect(x+radius,y+height-y,width-(radius*2.25),y); ctx.closePath();
	style = addLinearStyle(ctx,x+radius,y+height-y,x+radius,y+height,opacity);
	ctx.fillStyle = style; ctx.fill();
	ctx.beginPath(); ctx.rect(x+width-(radius*1.25),y+height-(radius*1.25),radius*1.25,radius*1.25); ctx.closePath();
	style = addRadialStyle(ctx,x+width-(radius*1.25),y+height-(radius*1.25),(radius*1.25)-1.5-x,x+width-(radius*1.25),y+height-(radius*1.25),radius*1.25,opacity);
	ctx.fillStyle = style; ctx.fill();
	ctx.beginPath(); ctx.moveTo(x+width-x,y+radius); ctx.lineTo(x+width,y+radius);
	ctx.quadraticCurveTo(x+width-x,y+(height/2),x+width,y+height-(radius*1.25));
	ctx.lineTo(x+width-x,y+height-(radius*1.25));
	ctx.quadraticCurveTo(x+width-(x*2),y+(height/2),x+width-x,y+radius); ctx.closePath();
	style = addLinearStyle(ctx,x+width-x,y+radius,x+width,y+radius,opacity);
	ctx.fillStyle = style; ctx.fill();
	ctx.beginPath(); ctx.rect(x+width-radius,y,radius,radius); ctx.closePath();
	style = addRadialStyle(ctx,x+width-radius,y+radius,radius-x,x+width-radius,y+radius,radius,opacity);
	ctx.fillStyle = style; ctx.fill();
}

function addIEInstant() {
	var theimages = getImages('instant');
	var image; var object; var vml; var display;
	var border = 16; var offset = 8; var scale = 1;
	var icolor = ''; var ishadow = 0; var noshading;
	var itiltright; var itiltnone;  var itiltleft;
	var color = ''; var tilt = 'r'; var opacity = 0;
	var preserve, head, foot, frame, fill, shadow, shade, shine;
	var classes = ''; var newClasses = '';
	var inset = 6; var i, f, flt, ww, hh, ff, yo, xo;
	for(i=0;i<theimages.length;i++) {
		image = theimages[i]; object = image.parentNode; 
		opacity = 0.33; color = '#f0f4ff'; preserve = 0;
		itiltright = 0; itiltnone = 0; itiltleft = 0; noshading = 0;
		if(image.width>=64 && image.height>=64) {
			classes = image.className.split(' ');
			ishadow = getClassValue(classes,"ishadow");
			if(ishadow>0) opacity=ishadow/100;
			icolor = getClassColor(classes,"icolor");
			if(icolor!=0) color = icolor;
			itiltleft = getClassAttribute(classes,"itiltleft");
			itiltright = getClassAttribute(classes,"itiltright");
			itiltnone = getClassAttribute(classes,"itiltnone");
			noshading = getClassAttribute(classes,"noshading");
			preserve = getClassAttribute(classes,"preserve");
			if(itiltright==true) tilt = 'r';
			if(itiltnone==true) tilt = 'n';
			if(itiltleft==true) tilt = 'l';
			newClasses = getClasses(classes,"instant");
			width = image.width; height = image.height;
			border = Math.round(Math.max(width,height)*0.05);
			offset = border/2; inset = parseInt(offset*.75);
			ww=width-(border*2); hh=height-(border*2); 
			f = (noshading==0?"t":"f");
			if(tilt=='r') {
				rotation = 2.8; scale = 0.95; tilt = 'n';
			}else if(tilt=='n') {
				rotation = 0; scale = 1; tilt = 'l';
			}else if(tilt=='l') {
				rotation = -2.8; scale = 0.95; tilt = 'r';
			}
			display = (image.currentStyle.display.toLowerCase()=='block')?'block':'inline-block';        
			vml = document.createElement(['<var style="zoom:1;overflow:hidden;display:' + display + ';width:' + width + 'px;height:' + height + 'px;padding:0;">'].join(''));
			flt = image.currentStyle.styleFloat.toLowerCase();
			display = (flt=='left'||flt=='right')?'inline':display;
			head = '<v:group style="rotation:' + rotation + '; zoom:' + scale + '; display:' + display + '; margin:-1px 0 0 -1px; padding:0; position:relative; width:'+width+'px;height:'+height+'px;" coordsize="'+width+','+height+'"><v:rect strokeweight="0" filled="f" stroked="f" fillcolor="transparent" style="zoom:1;margin: 0;padding: 0;display:block;position:absolute;top:0px;left:0px;width:'+width+'px;height:'+height+';"><v:fill opacity="0" color="#000000" /></v:rect>';
			shadow = '<v:rect strokeweight="0" filled="t" stroked="f" fillcolor="#000000" style="filter:Alpha(opacity='+(opacity*100)+'), progid:dxImageTransform.Microsoft.Blur(PixelRadius='+inset+', MakeShadow=false); zoom:1;margin:0;padding:0;display:block;position:absolute;top:'+offset+'px;left:'+offset+'px;width:'+(width-(2*offset))+'px;height:'+(height-(2*offset))+';"><v:fill color="#000000" opacity="1" /></v:rect>';
			frame = '<v:rect strokeweight="0" filled="t" stroked="f" fillcolor="' + color + '" style="zoom:1;margin: 0;padding: 0;display:block;position:absolute;top:0px;left:0px;width:' + (width-offset) + 'px;height:' + (height-offset) + ';"></v:rect>';
			shine = '<v:rect strokeweight="0" filled="t" stroked="f" fillcolor="' + color + '" style="zoom:1;margin: 0;padding: 0;display:block;position:absolute;top:' + border + 'px;left:' + border + 'px;width:' + (width-offset-(2*border)) + 'px;height:' + (height-offset-(2*border)) + ';"><v:fill color="#000000" opacity="' + opacity + '" /></v:rect>';
			if(preserve==0) {
				fill = '<v:image src="'+image.src+'" style="zoom:1;margin:0;padding:0;display:block;position:absolute;top:'+border+'px;left:'+border+'px;width:'+(width-offset-(2*border))+'px;height:'+(height-offset-(2*border))+';"></v:image>';
			}else {
				if(width>height) {
					ff=(height/width); xo=0; yo=((ww*ff)-hh)/2; hh=(ww*ff); yo=(yo/(hh/100));
				}else if(width<height) {
					ff=(width/height); yo=0; xo=((hh*ff)-ww)/2; ww=(hh*ff); xo=(xo/(ww/100));
				}else {
					ff=1; xo=0; yo=0;
				}
				fill = '<v:image croptop="'+yo+'%" cropbottom="'+yo+'%" cropleft="'+xo+'%" cropright="'+xo+'%" src="'+image.src+'" style="zoom:1;margin:0;padding:0;display:block;position:absolute;top:'+border+'px;left:'+border+'px;width:'+(width-offset-(2*border))+'px;height:'+(height-offset-(2*border))+';"></v:image>';
			}
			shade = '<v:rect strokeweight="3" filled="'+f+'" stroked="t" strokecolor="' + color + '" fillcolor="transparent" style="zoom:1;margin: 0;padding: 0;display:block;position:absolute;top:' + border + 'px;left:' + border + 'px;width:' + (width-offset-(2*border)) + 'px;height:' + (height-offset-(2*border)) + ';"><v:fill method="sigma" type="gradient" angle="0" color="#ffffff" opacity="'+(opacity/2)+'" color2="#000000" o:opacity2="'+(opacity/2)+'" /></v:rect>';
			foot = '</v:group>';
			vml.innerHTML = head+shadow+frame+shine+fill+shade+foot;
			vml.className = newClasses;
			vml.style.cssText = image.style.cssText;
			vml.style.visibility = 'visible';
			vml.src = image.src; vml.alt = image.alt;
			vml.width = image.width; vml.height = image.height;
			if(image.id!='') vml.id = image.id;
			if(image.title!='') vml.title = image.title;
			if(image.getAttribute('onclick')!='') vml.setAttribute('onclick',image.getAttribute('onclick'));
			object.replaceChild(vml,image);
		}
	}
}

function addInstant() {
	var isOp = navigator.userAgent.indexOf('Opera') > -1 ? 1 : 0;
	var theimages = getImages('instant'); 
	var image; var object; var canvas; var context;  
	var border = 16; var offset = 8; var inset = 2; 
	var icolor = ''; var ishadow = 0; var noshading; 
	var itiltright; var itiltnone;  var itiltleft;
	var color = ''; var tilt = 'r'; var opacity = 0;  
	var classes = ''; var newClasses = ''; var style = '';
	var scale = 0; var xscale = 1; var yscale = 1;
	var i, ww, hh, ff, yo, xo, preserve; 
	for(i=0;i<theimages.length;i++) {	
		image = theimages[i]; object = image.parentNode; 
		canvas = document.createElement('canvas');
		opacity = 0.33; color = '#f0f4ff'; preserve = 0;
		itiltright = 0; itiltnone = 0; itiltleft = 0; noshading = 0;
		if(canvas.getContext && image.width>=64 && image.height>=64) {
			classes = image.className.split(' '); 
			ishadow = getClassValue(classes,"ishadow");
			if(ishadow>0) opacity=ishadow/100;
			icolor = getClassColor(classes,"icolor");
			if(icolor!=0) color = icolor;
			itiltleft = getClassAttribute(classes,"itiltleft");
			itiltright = getClassAttribute(classes,"itiltright");
			itiltnone = getClassAttribute(classes,"itiltnone");
			noshading = getClassAttribute(classes,"noshading");
			preserve = getClassAttribute(classes,"preserve");
			if(itiltright==true) tilt = 'r';
			if(itiltnone==true) tilt = 'n';
			if(itiltleft==true) tilt = 'l';
			newClasses = getClasses(classes,"instant");
			canvas.className = newClasses;
			canvas.style.cssText = image.style.cssText;
			canvas.style.height = image.height+'px';
			canvas.style.width = image.width+'px';
			canvas.height = image.height;
			canvas.width = image.width;
			canvas.src = image.src; canvas.alt = image.alt;
			if(image.id!='') canvas.id = image.id;
			if(image.title!='') canvas.title = image.title;
			if(image.getAttribute('onclick')!='') canvas.setAttribute('onclick',image.getAttribute('onclick'));
			border = Math.round(Math.max(canvas.width,canvas.height)*0.05);
			offset = border/2; ww=canvas.width-(border*2); hh=canvas.height-(border*2);
			inset = Math.floor(Math.min(Math.max(border/8,1),2));
			if(canvas.width>canvas.height) {
				xscale = 0.05; yscale = xscale*(canvas.width/canvas.height);
			}else if(canvas.width<canvas.height) {
				yscale = 0.05; xscale = yscale*(canvas.height/canvas.width);
			}else {xscale = 0.05; yscale = 0.05;}
			context = canvas.getContext("2d");
			object.replaceChild(canvas,image);
			context.clearRect(0,0,canvas.width,canvas.height);
			context.save(); scale = 1.333333; 
			if(tilt=='r') {
				context.translate(border,0);
				context.scale(1-(scale*xscale),1-(scale*yscale));
				context.rotate(0.05); tilt = 'n';
			}else if(tilt=='n') {
				scale = 1.5; tilt = 'l';
				context.scale(1-(xscale/scale),1-(yscale/scale));
			}else if(tilt=='l') {
				context.translate(0,border);
				context.scale(1-(scale*xscale),1-(scale*yscale));
				context.rotate(-0.05); tilt = 'r';
			}
			tiltShadow(context,offset,offset,canvas.width,canvas.height,offset,opacity);
			context.fillStyle = color;
			context.fillRect(0,0,canvas.width,canvas.height);
			context.fillStyle = 'rgba(0,0,0,'+opacity+')';
			context.fillRect(border,border,canvas.width-(border*2),canvas.height-(border*2));
			if(!isOp) addLining(context,1.5,1.5,canvas.width-3,canvas.height-3,opacity,inset,false,color);
			if(preserve==0) {
				context.drawImage(image,border,border,canvas.width-(border*2),canvas.height-(border*2));
			}else {
				if(canvas.width>canvas.height) {
					ff=(canvas.height/canvas.width); xo=0; yo=((ww*ff)-hh)/2; hh=(ww*ff);
				}else if(canvas.width<canvas.height) {
					ff=(canvas.width/canvas.height); yo=0; xo=((hh*ff)-ww)/2; ww=(hh*ff);
				}else {
					ff=1; xo=0; yo=0;
				}
				context.save();
				context.beginPath();  
				context.rect(border,border,ww-(2*xo),hh-(2*yo));
				context.closePath();
				context.clip();
				context.drawImage(image,border-xo,border-yo,ww,hh);
				context.restore();
			}
			if(noshading==0) addShading(context,border,border,canvas.width-(border*2),canvas.height-(border*2),opacity);
			if(!isOp) addLining(context,border,border,canvas.width-(border*2),canvas.height-(border*2),opacity,inset,true);
			context.restore();
			canvas.style.visibility = 'visible';
		}
	}
}

var instantOnload = window.onload;
window.onload = function () { if(instantOnload) instantOnload(); if(isIE){addIEInstant(); }else {addInstant();}}