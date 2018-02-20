/**
 * cvi_instant_lib.js 1.5 (17-Mar-2008)
 * (c) by Christian Effenberger
 * All Rights Reserved
 * Source: instant.netzgesta.de
 * Distributed under Netzgestade Software License Agreement
 * http://www.netzgesta.de/cvi/LICENSE.txt
 * License permits free of charge
 * use on non-commercial and
 * private web sites only
 * syntax:
	cvi_instant.defaultTilt = 'none'; 		//STR  'n|l|r'-'none|left|right'
	cvi_instant.defaultShade = 33;  		//INT  0-100 (% opacity)
	cvi_instant.defaultShadow = 33;  		//INT  0-100 (% opacity)
	cvi_instant.defaultColor = '#f0f4ff'; 	//STR '#000000'-'#ffffff'
	cvi_instant.defaultNoshade = false; 	//BOOLEAN
	cvi_instant.defaultPreserve = false; 	//BOOLEAN
	cvi_instant.remove( image );
	cvi_instant.add( image, options );
	cvi_instant.modify( image, options );
	cvi_instant.add( image, { tilt: value, shadow: value, color: value, noshade: value, preserve: value } );
	cvi_instant.modify( image, { tilt: value, shadow: value, color: value, noshade: value, preserve: value } );
 *
**/

function addShading(ctx,x,y,width,height,opacity) {
	var style = ctx.createLinearGradient(0,y,0,y+height);
	style.addColorStop(0,'rgba(0,0,0,'+(opacity/2)+')');
	style.addColorStop(0.3,'rgba(0,0,0,0)');
	style.addColorStop(0.7,'rgba(254,254,254,0)');
	style.addColorStop(1,'rgba(254,254,254,'+(opacity)+')');
	ctx.beginPath();
	ctx.rect(x,y,width,height);
	ctx.closePath();
	ctx.fillStyle = style;
	ctx.fill();
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
			style.addColorStop(1,'rgba(192,192,192,0.0)');
		}else {
			style.addColorStop(0,'rgba(254,254,254,0.0)');
			style.addColorStop(1,'rgba(192,192,192,0.0)');
		}
	}
	ctx.beginPath(); ctx.rect(x,y,width,height); ctx.closePath();
	ctx.strokeStyle = style; ctx.lineWidth = inset; ctx.stroke();
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
	ctx.beginPath(); ctx.moveTo(x+width-x,y+radius); ctx.lineTo(x+width,y+radius); ctx.quadraticCurveTo(x+width-x,y+(height/2),x+width,y+height-(radius*1.25)); ctx.lineTo(x+width-x,y+height-(radius*1.25)); ctx.quadraticCurveTo(x+width-(x*2),y+(height/2),x+width-x,y+radius); ctx.closePath();
	style = addLinearStyle(ctx,x+width-x,y+radius,x+width,y+radius,opacity);
	ctx.fillStyle = style; ctx.fill();
	ctx.beginPath(); ctx.rect(x+width-radius,y,radius,radius); ctx.closePath();
	style = addRadialStyle(ctx,x+width-radius,y+radius,radius-x,x+width-radius,y+radius,radius,opacity);
	ctx.fillStyle = style; ctx.fill();
}

var cvi_instant = {
	defaultTilt : 'none',
	defaultShadow : 33,
	defaultColor : '#f0f4ff',
	defaultNoshade : false,
	defaultPreserve : false,
	add: function(image, options) {
		if(image.tagName.toUpperCase() == "IMG") {
			var defopts = { "tilt" : cvi_instant.defaultTilt, "shade" : cvi_instant.defaultShade, "shadow" : cvi_instant.defaultShadow, "color" : cvi_instant.defaultColor , "noshade" : cvi_instant.defaultNoshade , "preserve" : cvi_instant.defaultPreserve }
			if(options) {
				for(var i in defopts) { if(!options[i]) { options[i] = defopts[i]; }}
			}else {
				options = defopts;
			}
			var imageWidth  = ('iwidth'  in options) ? parseInt(options.iwidth)  : image.width;
			var imageHeight = ('iheight' in options) ? parseInt(options.iheight) : image.height;
			try {
				var object = image.parentNode;
				if(document.all && document.namespaces && !window.opera) {
					if(document.namespaces['v'] == null) {
						var stl = document.createStyleSheet();
						stl.addRule("v\\:*", "behavior: url(#default#VML);");
						document.namespaces.add("v", "urn:schemas-microsoft-com:vml");
					}
					var display = (image.currentStyle.display.toLowerCase()=='block')?'block':'inline-block';
					var canvas = document.createElement(['<var style="zoom:1;overflow:hidden;display:'+display+';width:'+imageWidth+'px;height:'+imageHeight+'px;padding:0;">'].join(''));
					var flt =  image.currentStyle.styleFloat.toLowerCase();
					display = (flt=='left'||flt=='right')?'inline':display;
					canvas.options = options;
					canvas.dpl = display;
					canvas.id = image.id;
					canvas.alt = image.alt;
					canvas.name = image.name;
					canvas.title = image.title;
					canvas.source = image.src;
					canvas.className = image.className;
					canvas.style.cssText = image.style.cssText;
					canvas.height = imageHeight;
					canvas.width = imageWidth;
					object.replaceChild(canvas,image);
					cvi_instant.modify(canvas, options);
				}else {
					var canvas = document.createElement('canvas');
					if(canvas.getContext("2d")) {
						canvas.options = options;
						canvas.isOP = navigator.userAgent.indexOf('Opera') > -1 ? 1 : 0;
						canvas.id = image.id;
						canvas.alt = image.alt;
						canvas.name = image.name;
						canvas.title = image.title;
						canvas.source = image.src;
						canvas.className = image.className;
						canvas.style.cssText = image.style.cssText;
						canvas.style.height = imageHeight+'px';
						canvas.style.width = imageWidth+'px';
						canvas.height = imageHeight;
						canvas.width = imageWidth;
						object.replaceChild(canvas,image);
						cvi_instant.modify(canvas, options);
					}
				}
			} catch (e) {
			}
		}
	},

	modify: function(canvas, options) {
		try {
			var tilt = (typeof options['tilt']=='string'?options['tilt']:canvas.options['tilt']); canvas.options['tilt']=tilt;
			var shade = (typeof options['shade']=='number'?options['shade']:canvas.options['shade']); canvas.options['shade']=shade;
			var shadow = (typeof options['shadow']=='number'?options['shadow']:canvas.options['shadow']); canvas.options['shadow']=shadow;
			var color = (typeof options['color']=='string'?options['color']:canvas.options['color']); canvas.options['color']=color;
			var noshade = (typeof options['noshade']=='boolean'?options['noshade']:canvas.options['noshade']); canvas.options['noshade']=noshade;
			var preserve = (typeof options['preserve']=='boolean'?options['preserve']:canvas.options['preserve']); canvas.options['preserve']=preserve;
			var ih = canvas.height; var iw = canvas.width; var ishade = shadow==0?0.1:shade/100;
			var ishadow = shadow==0?0.33:shadow/100; var itilt = (tilt.match(/^[lnr]/i)?tilt.substr(0,1):'n');
			var icolor = (color.match(/^#[0-9a-f][0-9a-f][0-9a-f][0-9a-f][0-9a-f][0-9a-f]$/i)?color:'#f0f4ff');
			var bd = Math.round(Math.max(iw,ih)*0.05); var os = bd/2; var sc = 1.333333; var ww=iw-(bd*2); var hh=ih-(bd*2);
			if(iw>ih) {var xs = 0.05; var ys = xs*(iw/ih);}else if(iw<ih) {var ys = 0.05; var xs = ys*(ih/iw);}else {var xs = 0.05; var ys = 0.05;}
			var f, it, rt, ff, yo, xo, head, foot, shadow, shade, shine, frame, fill;
			if(document.all && document.namespaces && !window.opera) {
				if(canvas.tagName.toUpperCase() == "VAR") {
					f = (noshade==false?'t':'f'); it = parseInt(os*.75); if(itilt=='r') {rt=2.8; sc=0.95;}else if(itilt=='l') {rt=-2.8; sc=0.95;}else {rt=0; sc=1;}
					head = '<v:group style="rotation:'+rt+';zoom:'+sc+';display:'+canvas.dpl+';margin:0;padding:0;position:relative;width:'+iw+'px;height:'+ih+'px;" coordsize="'+iw+','+ih+'"><v:rect strokeweight="0" filled="f" stroked="f" fillcolor="transparent" style="zoom:1;margin:0;padding:0;display:block;position:absolute;top:0px;left:0px;width:'+iw+'px;height:'+ih+';"><v:fill opacity="0" color="#000000" /></v:rect>';
					shadow = '<v:rect strokeweight="0" filled="t" stroked="f" fillcolor="#000000" style="filter:Alpha(opacity='+(ishadow*100)+'), progid:dxImageTransform.Microsoft.Blur(PixelRadius='+it+', MakeShadow=false); zoom:1;margin:0;padding:0;display:block;position:absolute;top:'+os+'px;left:'+os+'px;width:'+(iw-(2*os))+'px;height:'+(ih-(2*os))+';"><v:fill color="#000000" opacity="1" /></v:rect>';
					frame = '<v:rect strokeweight="0" filled="t" stroked="f" fillcolor="'+icolor+'" style="zoom:1;margin:0;padding:0;display:block;position:absolute;top:0px;left:0px;width:'+(iw-os)+'px;height:'+(ih-os)+';"></v:rect>';
					shine = '<v:rect strokeweight="0" filled="t" stroked="f" fillcolor="'+icolor+'" style="zoom:1;margin:0;padding:0;display:block;position:absolute;top:'+bd+'px;left:'+bd+'px;width:'+(iw-os-(2*bd))+'px;height:'+(ih-os-(2*bd))+';"><v:fill color="#000000" opacity="'+ishadow+'" /></v:rect>';
					if(preserve==false) {
						fill = '<v:image src="'+canvas.source+'" style="zoom:1;margin:0;padding:0;display:block;position:absolute;top:'+bd+'px;left:'+bd+'px;width:'+(iw-os-(2*bd))+'px;height:'+(ih-os-(2*bd))+';"></v:image>';
					}else {
						if(iw>ih) {
							ff=(ih/iw); xo=0; yo=((ww*ff)-hh)/2; hh=(ww*ff); yo=(yo/(hh/100));
						}else if(iw<ih) {
							ff=(iw/ih); yo=0; xo=((hh*ff)-ww)/2; ww=(hh*ff); xo=(xo/(ww/100));
						}else {
							ff=1; xo=0; yo=0;
						}
						fill = '<v:image croptop="'+yo+'%" cropbottom="'+yo+'%" cropleft="'+xo+'%" cropright="'+xo+'%" src="'+canvas.source+'" style="zoom:1;margin:0;padding:0;display:block;position:absolute;top:'+bd+'px;left:'+bd+'px;width:'+(iw-os-(2*bd))+'px;height:'+(ih-os-(2*bd))+';"></v:image>';
					}
					shade = '<v:rect strokeweight="3" filled="'+f+'" stroked="t" strokecolor="'+icolor+'" fillcolor="transparent" style="zoom:1;margin:0;padding:0;display:block;position:absolute;top:'+bd+'px;left:'+bd+'px;width:'+(iw-os-(2*bd))+'px;height:'+(ih-os-(2*bd))+';"><v:fill method="sigma" type="gradient" angle="0" color="#ffffff" opacity="'+(ishade/2)+'" color2="#000000" o:opacity2="'+(ishade/2)+'" /></v:rect>';
					foot = '</v:group>';
					canvas.innerHTML = head+shadow+frame+shine+fill+shade+foot;
				}
			}else {
				if(canvas.tagName.toUpperCase() == "CANVAS" && canvas.getContext("2d")) {
					it = Math.floor(Math.min(Math.max(bd/8,1),2));
					var context = canvas.getContext("2d");
					var img = new Image();
					img.onload = function() {
						context.clearRect(0,0,iw,ih);
						context.save();
						if(itilt=='r') {
							context.translate(bd,0); context.scale(1-(sc*xs),1-(sc*ys)); context.rotate(0.05);
						}else if(itilt=='n') {
							context.scale(1-(xs/1.5),1-(ys/1.5));
						}else if(itilt=='l') {
							context.translate(0,bd); context.scale(1-(sc*xs),1-(sc*ys)); context.rotate(-0.05);
						}
						tiltShadow(context,os,os,iw,ih,os,ishadow);
						context.fillStyle = icolor;
						context.fillRect(0,0,iw,ih);
						context.fillStyle = 'rgba(0,0,0,'+ishadow+')';
						context.fillRect(bd,bd,iw-(bd*2),ih-(bd*2));
						if(!canvas.isOP) {addLining(context,1.5,1.5,iw-3,ih-3,ishadow,it,false,icolor);}
						if(preserve==false) {
							context.drawImage(img,bd,bd,ww,hh);
						}else {
							if(iw>ih) {
								ff=(ih/iw); xo=0; yo=((ww*ff)-hh)/2; hh=(ww*ff);
							}else if(iw<ih) {
								ff=(iw/ih); yo=0; xo=((hh*ff)-ww)/2; ww=(hh*ff);
							}else {
								ff=1; xo=0; yo=0;
							}
							context.save(); context.beginPath();  
  							context.rect(bd,bd,ww-(2*xo),hh-(2*yo));
  							context.closePath(); context.clip();
							context.drawImage(img,bd-xo,bd-yo,ww,hh);
							context.restore();
						}
						if(noshade==false) {addShading(context,bd,bd,iw-(bd*2),ih-(bd*2),ishade);}
						if(!canvas.isOP) {addLining(context,bd,bd,iw-(bd*2),ih-(bd*2),ishadow,it,true);}
						context.restore();
					}
					img.src = canvas.source;
				}
			}
		} catch (e) {
		}
	},

	replace : function(canvas) {
		var object = canvas.parentNode;
		var img = document.createElement('img');
		img.id = canvas.id;
		img.alt = canvas.alt;
		img.title = canvas.title;
		img.src = canvas.source;
		img.className = canvas.className;
		img.style.cssText = canvas.style.cssText;
		img.style.height = canvas.height+'px';
		img.style.width = canvas.width+'px';
		object.replaceChild(img,canvas);
	},

	remove : function(canvas) {
		if(document.all && document.namespaces && !window.opera) {
			if(canvas.tagName.toUpperCase() == "VAR") {
				cvi_instant.replace(canvas);
			}
		}else {
			if(canvas.tagName.toUpperCase() == "CANVAS") {
				cvi_instant.replace(canvas);
			}
		}
	}
}