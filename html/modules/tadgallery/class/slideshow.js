//Slideshow RC2 for Mootools 1.0. Copyright (c) 2007 Aeron Glemann, <http://electricprism.com/aeron/slideshow>, MIT Style License.
//-------------------------------------------------------
//	Class: Slideshow
//	
//	  Slideshow is a javascript class to stream and animate the presentation of images on your website.
//	
//	Properties:
//	
//	  captions      - Array of HTML captions to accomodate slides. Captions are inserted into a P element
//	  classes       - An array of 3 class names for 'prev', 'next' and 'active' navigation elements
//	  duration      - An array of 2 values in milliseconds (1000 = 1 second). The first value indicates the duration of the effect, and the second the duration between slide changes
//	  height        - Optional height value for the slideshow as a whole integer. If a height value is not given the height of the default image will be used
//	  hu            - Relative path to the image directory. Default is the same directory as the web page
//	  images        - Array of image filenames found at the path above
//	  navigation    - Optional navigation controls. The navigation appears as anchors (A) within an unordered list (UL LI). If called with the optional 'fast' keyword (eg. 'arrows fast'), the slideshow will not wait until the current transition completes, but update the slide change instantly
//                  		arrows: Only previous and next controls
//                  		arrows+: Previous, next and controls to jump to any image
//                  		thumbnails: Controls to jump to any image represented as thumbnails. The thumbnail images must exist in the same directory as the full-size images and be named as expected by the slideshow (see thumbnailre)
//	  pan           - Optional value to customize slideshow panning movement. Acceptable values are whole integers between 1 and 100 or the keyword 'rand' which will generate a random value for each slide
//	  resize        - Boolean, true or false, whether images are resized (default is true). Resized images may not appear well in all browsers. Note: If you are using a 'zoom' or 'combo' type slideshow, images will be resized regardless
//	  thumbnailre   - An array used in a javascript replace to determine the file naming schema of thumbnail images. The first value is a regular expression (find) the second value is the new substring (replace)
//	  transition    - Optional name of Robert Penner transition to use with wipe and push type slideshows. Transitions are only available if Fx.Transitions.js is available in Mootools
//	  type          - Slideshow type
//                  		fade: Fades between slides
//                  		pan: Fades between slides and scrolls the image while it is visible
//                  		zoom: Fades between slides and zooms the image while it is visible
//                  		combo: Fades between slides and zooms and scrolls the image while it is visible, also known as the Ken Burns Effect
//                  		push: Pushes the old image out of the frame with the new one
//                  		wipe: Wipes the new image over the old one
//	  width       - Optional width value for the slideshow as a whole integer. If a width value is not given the width of the default image will be used
//	  zoom        - Optional value to customize slideshow zooming movement. Acceptable values are whole integers between 1 and 100 or the keyword 'rand' which will generate a random value for each slide
//-------------------------------------------------------

Slideshow = new Class({
	
//-------------------------------------------------------
//	Function: initialize
//
//	  Called automatically when a new slideshow instance is created.
//
//	Arguments:
//
//	  slideshow     - Instance or ID of element that wraps the slideshow images, usually a DIV
//	  props					- Property list as described for the class
//-------------------------------------------------------

	initialize: function(slideshow, props) {
		this.props = Object.extend({
			captions: false,
			classes: ['prev', 'next', 'active'],
			duration: [2000, 4000],
			height: false,
			hu: '/',
			images: [],
			navigation: false,
			pan: 100,
			resize: true,
			thumbnailre: [/\./, 't.'],
			transition: Fx.Transitions.sineInOut,
			type: 'fade',
			width: false,
			zoom: 50
		}, props || {});

		if (this.props.images.length <= 1) { return; }

		if (this.props.pan != 'rand') {
			if (isNaN(this.props.pan.toInt()) || this.props.pan.toInt() < 0 || this.props.pan.toInt() > 100) { this.props.pan = 0; }
		}

		if (this.props.zoom != 'rand') {
			if (isNaN(this.props.zoom.toInt()) || this.props.zoom.toInt() < 0 || this.props.zoom.toInt() > 100) { this.props.zoom = 0; }
		}

		this.slideshow = $(slideshow);

		this.a = img = $E('img', this.slideshow);

		this.fx = [];

		this.start();
	},

//-------------------------------------------------------
//	Function: start
//
//	  Sets class variables; creates slideshow, navigation and caption elements; resizes images.
//-------------------------------------------------------
	
	start: function() {
		this.slideshow.setHTML('');

		this.a.setStyles({display: 'block', position: 'absolute', left: '0px', top: '0px', zIndex: 1});
		this.a.injectInside(this.slideshow);
		
		this.fx.each(function(fx) { 
			fx.time = fx.options.duration = 0;
			fx.stop(true); 
		});		

		obj = this.a.getCoordinates();

		this.height = ((this.props.height) ? this.props.height : obj['height']);
		this.width = ((this.props.width) ? this.props.width : obj['width']);
		
		this.slideshow.setStyles({display: 'block', position: 'relative', width: this.width + 'px'});

		// Images appear within a bounding div inside of the slideshow div
		// This div may be used to attach events - such as myShow.div.onmouseover - in order to show / hide navigation or further manipulate the slideshow
		this.div = new Element('div');
		this.div.setStyles({display: 'block', height: (this.height + 'px'), overflow: 'hidden', position: 'relative', width: (this.width + 'px')});
		this.div.injectInside(this.slideshow);

		this.a.injectInside(this.div);

		if ((this.props.height || this.props.width) && this.props.resize) {			
			dh = this.height / obj['height'];
			dw = this.width / obj['width'];
	
			n = (dw > dh) ? dw : dh;

			this.a.setStyles({height: Math.ceil(obj['height'] * n) + 'px', width: Math.ceil(obj['width'] * n) + 'px'});
		}
				
		this.b = this.a.clone();
		this.b.setStyle('opacity', 0);
		this.b.injectAfter(this.a);

		if (this.props.navigation) { this.navigation(); }

		if ($type(this.props.captions) == 'array') {
			this.p = new Element('p');
			this.p.setHTML(this.props.captions[0]);
			this.p.injectInside(this.slideshow);
		}

		this.direction = 'left';
		this.curr = [1, 1];
		this.timer = (this.timer) ? [0] : [(new Date).getTime() + this.props.duration[1], 0];

		this.loader = new Image();
		this.loader.src = this.props.hu + this.props.images[this.curr[0]].trim();

		this.preload();
	},

//-------------------------------------------------------
//	Function: preload
//
//	  Loops until new image has loaded or delay has been met; calculates and executes effects.
//
//	Arguments:
//
//	  fast     		- True if the navigation is in 'fast' mode
//-------------------------------------------------------

	preload: function(fast) {
		if (this.loader.complete && ((new Date).getTime() > this.timer[0])) {
			img = (this.curr[1] % 2) ? this.b : this.a;
			img.setStyles({height: 'auto', opacity: 0, width: 'auto', zIndex: this.curr[1]});
			img.setProperty('src', this.loader.src);	
			
			dh = this.height / this.loader.height;
			dw = this.width / this.loader.width;

			n = (dw > dh) ? dw : dh;

			if (this.props.resize) { img.setStyles({height: Math.ceil(this.loader.height * n) + 'px', width: Math.ceil(this.loader.width * n) + 'px'}); }
			
			if (fast) {
				img.setStyles({left: '0px', opacity: 1, top: '0px'});
				if ($type(this.props.captions) == 'array') { this.p.setHTML(this.props.captions[this.curr[0]]).setStyle('opacity', 1); }
				return this.loaded();
			}

			this.fx = [];

			if ($type(this.props.captions) == 'array') {
				fn = function(i) {
					if (this.props.captions[i]) { this.p.setHTML(this.props.captions[i]); }
					
					fx = new Fx.Style(this.p, 'opacity');
					fx.start(0, 1);
					this.fx.push(fx);
				}.pass(this.curr[0], this);
	
				fx = new Fx.Style(this.p, 'opacity', {onComplete: fn});
				fx.start(1, 0);
				this.fx.push(fx);
			}

			if (this.props.type.test(/push|wipe/)) {
				img.setStyles({left: 'auto', right: 'auto'});
				img.setStyle(this.direction, this.width + 'px');
				img.setStyle('opacity', 1);

				if (this.props.type == 'wipe') {
					fx = new Fx.Style(img, this.direction, {duration: this.props.duration[0], transition: this.props.transition});
					fx.start(this.width, 0);
					this.fx.push(fx);
				} 
				else {
					arr = [img, ((this.curr[1] % 2) ? this.a : this.b)];

					p0 = {};					
					p0[this.direction] = [this.width, 0];
					p1 = {};
					p1[this.direction] = [0, (this.width * -1)];

					// Navigation has changed direction
					// The image shifts when changing from right <> left so we need to correct the positioning
					if (arr[1].getStyle(this.direction) == 'auto') {
						x = this.width - arr[1].getStyle('width').toInt();
					
						arr[1].setStyle(this.direction, x + 'px');
						arr[1].setStyle(((this.direction == 'left') ? 'right' : 'left'), 'auto');
						 
						p1[this.direction] = [x, (this.width * -1)];
					}
					
					fx = new Fx.Elements(arr, {duration: this.props.duration[0], transition: this.props.transition});
					fx.start({'0': p0, '1': p1});
					this.fx.push(fx);						
				}
			} 
			else {	
				img.setStyles({bottom: 'auto', left: 'auto', right: 'auto', top: 'auto'});

				arr = ['left top', 'right top', 'left bottom', 'right bottom'][this.curr[1] % 4].split(' ');
				arr.each(function(p) { img.setStyle(p, 0); });

				zoom = ((this.props.type).test(/zoom|combo/)) ? this.zoom() : {};
					
				pan = ((this.props.type).test(/pan|combo/)) ? this.pan() : {};
				
				fx = new Fx.Style(img, 'opacity', {duration: this.props.duration[0]});
				fx.start(0, 1);
				this.fx.push(fx);

				fx = new Fx.Styles(img, {duration: (this.props.duration[0] + this.props.duration[1]), transition: Fx.Transitions.linear});
				fx.start(Object.extend(zoom, pan));
				this.fx.push(fx);
			}

			this.loaded();
		}
		else { this.timeout = this.preload.delay(100, this); }
	},

//-------------------------------------------------------
//	Function: loaded
//
//	  Sets next image in slideshow; updates status of navigation elements.
//-------------------------------------------------------

	loaded: function() {
		if (this.ul) {
			anchors = $ES('a[name]', this.ul);
			anchors.each(function(a, i) {
				if (i == this.curr[0]) { a.addClass(this.props.classes[2]); }
				else { a.removeClass(this.props.classes[2]); }
			}, this);
		}

		this.direction = 'left';
		this.curr[0] = (this.curr[0] == this.props.images.length - 1) ? 0 : this.curr[0] + 1;
		this.curr[1]++;
		this.timer[0] = (new Date).getTime() + this.props.duration[1] + ((this.props.type.test(/fade|push|wipe/)) ? this.props.duration[0] : 0);
		this.timer[1] = (new Date).getTime() + this.props.duration[0];

		this.loader = new Image();
		this.loader.src = this.props.hu + this.props.images[this.curr[0]].trim();
		
		this.preload();
	},

//-------------------------------------------------------
//	Function: zoom
//
//	  Calculates degree of zooming based on image and slideshow properties.
//
//	Returns:
//
//	  A property array with the height and width styles for the effect.
//-------------------------------------------------------

	zoom: function() {
		z = (this.props.zoom == 'rand') ? Math.random() + 1 : (this.props.zoom.toInt() / 100.0) + 1;

		eh = Math.ceil(this.loader.height * n);
		ew = Math.ceil(this.loader.width * n);

		sh = parseInt(eh * z);
		sw = parseInt(ew * z);

		return {height: [sh, eh], width: [sw, ew]};
	},

//-------------------------------------------------------
//	Function: pan
//
//	  Calculates degree of panning based on image and slideshow properties.
//
//	Returns:
//
//	  A property array with the left and right styles for the effect.
//-------------------------------------------------------

	pan: function() {
		p = (this.props.pan == 'rand') ? Math.random() : Math.abs((this.props.pan.toInt() / 100.0) - 1);

		ex = (this.width - img.width);
		ey = (this.height - img.height);

		sx = parseInt(ex * p);
		sy = parseInt(ey * p);

		obj = {};

		if (dw > dh) { obj[arr[1]] = [sy, ey] }
		else { obj[arr[0]] = [sx, ex]; }
		
		return obj;
	},

//-------------------------------------------------------
//	Function: navigation
//
//	  Generates navigation elements / functionality based on slideshow properties
//-------------------------------------------------------

	navigation: function() {
		this.ul = new Element('ul');

		if (this.props.navigation.test(/arrows/)) {
			li = new Element('li');

			a = new Element('a');
			a.addClass(this.props.classes[0]);
			a.onclick = function() {
				if (this.props.navigation.test(/fast/) || (new Date).getTime() > this.timer[1]) {	
					$clear(this.timeout);
			
					// Clear the FX array only for fast navigation since this stops combo effects
					if (this.props.navigation.test(/fast/)) {
						this.fx.each(function(fx) { 
							fx.time = fx.options.duration = 0;
							fx.stop(true); 
						});
					}

					this.direction = 'right';
					this.curr[0] = (this.curr[0] < 2) ? this.props.images.length - (2 - this.curr[0]) : this.curr[0] - 2;
					this.timer = [0];
					
					this.loader = new Image();
					this.loader.src = this.props.hu + this.props.images[this.curr[0]].trim();

					this.preload(this.props.navigation.test(/fast/));
				}
			}.bind(this);
			a.injectInside(li);
			
			li.injectInside(this.ul);
		}
		
		if (this.props.navigation.test(/arrows\+|thumbnails/)) {
			for (i = 0; i < this.props.images.length; i++) {
				li = new Element('li');

				a = new Element('a');
				a.setProperty('name', i);
				if (this.props.navigation.test(/thumbnails/)) {
					src = this.props.hu + this.props.images[i].trim().replace(this.props.thumbnailre[0], this.props.thumbnailre[1]);
					a.setStyle('background-image', 'url(' + src + ')');
				}
				if (i == 0) { a.className = this.props.classes[2]; }
				a.onclick = function(i) {
					if (this.props.navigation.test(/fast/) || (new Date).getTime() > this.timer[1]) {	
						$clear(this.timeout);
				
						// Clear the FX array only for fast navigation since this stops combo effects
						if (this.props.navigation.test(/fast/)) {
							this.fx.each(function(fx) { 
								fx.time = fx.options.duration = 0;
								fx.stop(true); 
							});
						}
						
						this.direction = (i < this.curr[0] || this.curr[0] == 0) ? 'right' : 'left';
						this.curr[0] = i;
						this.timer = [0];			
		
						this.loader = new Image();
					  this.loader.src = this.props.hu + this.props.images[this.curr[0]].trim();
		
						this.preload(this.props.navigation.test(/fast/));
					}
				}.pass(i, this);
				a.injectInside(li);
				
				li.injectInside(this.ul);
			}
		}

		if (this.props.navigation.test(/arrows/)) {
			li = new Element('li');
	
			a = new Element('a');
			a.addClass(this.props.classes[1]);
			a.onclick = function() {
				if (this.props.navigation.test(/fast/) || (new Date).getTime() > this.timer[1]) {	
					$clear(this.timeout);

					// Clear the FX array only for fast navigation since this stops combo effects
					if (this.props.navigation.test(/fast/)) {
						this.fx.each(function(fx) { 
							fx.time = fx.options.duration = 0;
							fx.stop(true); 
						});
					}

					this.timer = [0];					

					this.preload(this.props.navigation.test(/fast/));
				}
			}.bind(this);
			a.injectInside(li);
			
			li.injectInside(this.ul);
		}

		this.ul.injectInside(this.slideshow);
	}
});