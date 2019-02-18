var places = [], newflight, cplaceview;
var data = _.compact(posts);
	
$(function(){
	$(".airplane").hide();
	var Place = Backbone.Model.extend({
		defaults: function() {
			return {
				title: "Place"
			}
		}
	});
	
	var Plan = Backbone.Collection.extend({
		model: Place
	});
	
	var FlightPlan = Backbone.Model.extend({
		defaults: function(){
			return {pointa: "1,1", pointb: "100,100"};
		}
	});

	
	var Flight = Backbone.Model.extend({
		defaults: function(){
			return {carrier: "Jetstar", cost: "0", departuredate: "2014-01-01"};
		}
	});
	
	var FlightView = Backbone.View.extend({
		tagName: "div",
		template: _.template($("#flight-template").html()),
		render: function(){
			this.$el.html(this.template(this.model.toJSON()));
			return this;
		}
	});
	var DayTagView = Backbone.View.extend({
		tagName: "div",
		template: _.template($("#daytag-template").html()),
		render: function(){
			this.$el.html(this.template(dayNum));
			return this;
		},
		initialize: function(arg){
			this.dayNum = arg;
		}
	});
	
	var PlaceView = Backbone.View.extend({
		tagName: "li",
		template: _.template($("#place-template").html()),
		render: function() {
			this.$el.html(this.template(this.model.toJSON()));
			return this;
		},
		initialize: function(arg) {
			this.marker = arg.marker;
		},
		alert: function() {
			if(!_.isUndefined(cplaceview))cplaceview.unalert();
			cplaceview = this;
			this.marker.getMap().panTo(strtocoord(this.model.attributes.position));
			this.marker.setOpacity(1);
		},
		unalert: function() {
			this.marker.setOpacity(0.2);
		},
		scrollTo: function() {
			$.scrollTo(this.$el.offset().top - 100, 100);
		},
		events: {
        	"click": "alert"
        }
	});
	
	var FlightButtonView = Backbone.View.extend({
		tagName: "li",
		template: _.template($("#flight-button-template").html()),
		render: function() {
			this.$el.html(this.template());
			return this;
		},
		initialize: function(arg){
			this.pla = arg.pla;
			this.plb = arg.plb;
		},
		startflightplan: function(){
			var flightplanview = new FlightPlanView({
				model: new FlightPlan({
					pointa: this.pla.model.attributes.position,
					pointb: this.plb.model.attributes.position
				})
			});
			flightplanview.render();
			bootbox.alert($(".airplane").html());
		},
		events : {
        	"click": "startflightplan"
        }
	});
	

	var FlightPlanView = Backbone.View.extend({
		el: $(".airplane"),
		render: function(){
			var x = getAirport(this.model.attributes.pointa), y = getAirport(this.model.attributes.pointb);
			for(var i = 0; i < 3; ++i){
				for(var j = 0; j < 3; ++j){
					var t = getFlights(x[i], y[j]);
					var carriername = {};
					_.each(t.contents.Carriers, function(k){
						carriername[k.CarrierId] = k.Name;
					});
					var that = this;
					_.each(t.contents.Quotes, function(k){
						var g = new Flight();
						g.set({
							direct: k.Direct,
							departuredate: moment(k.InboundLeg.DepartureDate).format("LL"),
							carrier: carriername[k.InboundLeg.CarrierIds[0]],
							cost: k.MinPrice,
							airport1: x[i].name,
							airport2: y[j].name
						});
						var gg = new FlightView({model: g});
						gg.render();
						that.$el.append(gg.el);
					});
				}
			}
		}
	});
	
	var PlanView = Backbone.View.extend({
		el: $(".plan"),
		initialize: function() {
		    var options = {
		        zoom: 16,
		        center: new google.maps.LatLng(1.3031827999999999, 103.7926688),
		        mapTypeId: google.maps.MapTypeId.ROADMAP
		    };

		    this.viewlist = [];

		    this.my_map = new google.maps.Map($("#gmaps-canvas")[0], options);
			this.collection = new Plan(data);
			this.render();
		},
		render: function() {
			var that = this;
			_.each(this.collection.models, function(item) {
				var t = that.renderPlace(item);
				/*if(this.viewlist.length > 1){
					this.$el.append(this.renderFlightButton(this.viewlist[this.viewlist.length-2], this.viewlist[this.viewlist.length-1]));
				}*/
				this.$el.append(t);
			}, this);
			this.$el.children().first().click();
		},
		/*renderFlightButton: function(pla, plb){
			var t = new FlightButtonView({pla: pla, plb: plb});
			t.render();
			this.$el.append(t.el);
		}*/
		renderDayTag: function(day){
		var t = new DayTagView(day);
		t.render();	
		this.$el.append(t.el);
		},
		renderPlace: function(item) {
			var potato = this.my_map;
			var marker = new google.maps.Marker({
		        position: strtocoord(item.attributes.position),
		        map: potato,
		        opacity: 0.2
		    });

			$.ajax({
				url: "http://maps.googleapis.com/maps/api/geocode/json",
				type: "GET",
				async: false,
				data: {
					latlng: item.attributes.position,
					sensor: false
				},
				success: function(data) {
					if(data.status != 'ZERO_RESULTS') item.attributes.address = data.results[0].formatted_address;
				}
			});
			
			var placeview = new PlaceView({model: item, marker: marker});
		    google.maps.event.addListener(marker, "click", (function(marker, item) {
		        return function() {
					placeview.alert();
					placeview.scrollTo();
		        }
		    })(marker, item));
			
			this.viewlist.push(placeview);
			return placeview.render().el;
		}
	});
	var planview = new PlanView();
});

function getFlights(fa, fb) {
	var ret;
	$.ajax({
		url:"js/proxy.php",
		data: {url: "http://partners.api.skyscanner.net/apiservices/browsedates/v1.0/SG/SGD/en-GB/"+fa.code+"/"+fb.code+"/anytime/anytime?apikey=ah098907833924929719682178743053"},
		async: false,
		success: function(data){
			ret = data;
		}
	});
	return ret;
}

function getAirport(pos){
	var t;
	$.ajax({
		url: "js/proxy.php",
		type: "GET",
		async: false,
		data:{
			url: "http://airports.pidgets.com/v1/airports?near=" + pos + "&format=json"
		},
		success: function(data){
			t = data.contents;
		}
	});
	return t;
}

$(window).resize(function () {
	$(".gmaps-canvas").width($(".gmaps-canvas-placeholder").width()).css("right", $(".container").css("margin-right"));
	$("#gmaps-canvas").height($(window).height() - $(".gmaps-canvas").offset().top + window.pageYOffset - 50);
	cplaceview.marker.getMap().panTo(cplaceview.marker.getPosition());
});

$(window).resize();