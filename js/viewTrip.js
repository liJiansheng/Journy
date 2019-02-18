function addPlanPost(pid) {
	$.ajax({
		url: "addPlanPost.php",
		data: {pid: pid},
		success: function(){
			$("#addbtn-" + pid + " .glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-saved");
		}
	})
}

var cplaceview;

var dates = [];

_.each(_.indexBy(_.compact(posts), "tdate"), function(post) {
	var d = new Date(parseFloat(post.tdate)*1000);
		day = moment(d.toISOString()).format("LL");
	
	dates.push(day);
});

var postList = [];

_.each(_.indexBy(_.compact(posts), "tdate"), function(post) {
	if (!_.isEmpty(postList)) {
		var date1 = new Date(parseFloat(_.last(_.last(postList)).tdate)*1000);
		var formattedDate1 = moment(date1.toISOString()).format("LL");
		
		var date2 = new Date(parseFloat(post.tdate)*1000);
		var formattedDate2 = moment(date2.toISOString()).format("LL");
		
		if (formattedDate1 == formattedDate2) {
			_.last(postList).push(post)
		}
		
		else {
			postList.push([post]);
		}
	}
	
	else {
		postList.push([post]);
	}
});

var days = [];
var days_id = 1;

_.each(postList, function(day_posts) {
	days.push({
		id: days_id,
		title: "Day " + days_id,
		posts: day_posts
	});
	
	days_id++;
});

var markerlist = [];

function recenter(markerid) {
	if (!_.isUndefined(cplaceview)) {
		markerlist[cplaceview].setOpacity(0.5);
	}
	
	markerlist[markerid].getMap().panTo(markerlist[markerid].getPosition());
	markerlist[markerid].setOpacity(1);
	cplaceview = markerid;
}

$(window).scroll(function() {
	var postsY = [];
	$(".post").each(function() {
		if ($(this).offset().top + $(this).height()/2 < window.pageYOffset + $(window).height()/2) {
			postsY.push(window.pageYOffset + $(window).height()/2 - $(this).offset().top - $(this).height()/2);
		}
		
		else if ($(this).offset().top + $(this).height()/2 > window.pageYOffset + $(window).height()/2) {
			postsY.push($(this).offset().top + $(this).height()/2 - window.pageYOffset - $(window).height()/2);
		}
	});
	
	recenter($(".post:eq(" + _.indexOf(postsY, _.min(postsY)) + ")").attr("data-marker-id"));
});

$(function() {
	var Day = Backbone.Model.extend({
		defaults: function() {
			return {
				day: ""
			}
		}
	});
	
	var Trip = Backbone.Collection.extend({
		model: Day
	});
	
	var DayView = Backbone.View.extend({
		tagName: "li",
		template: _.template($("#day-template").html()),
		render: function() {
			this.$el.html(this.template(this.model.toJSON()));
			return this;
		}
	});
	
	var TripView = Backbone.View.extend({
		el: $(".timeline"),
		initialize: function() {
			var options = {
		        zoom: 16,
		        center: new google.maps.LatLng(1.3031827999999999, 103.7926688),
				mapTypeId: google.maps.MapTypeId.ROADMAP
		    };
			
			this.my_map = new google.maps.Map($("#gmaps-canvas")[0], options);
			
			this.collection = new Trip(days);
			this.render();
		},
		render: function() {
			var that = this;
			_.each(this.collection.models, function(item) {
				that.renderDay(item);
			}, this);
		},
		renderDay: function(item) {
			var date = new Date(parseFloat(item.attributes.posts[0].tdate)*1000);
			item.attributes.day = moment(date.toISOString()).format("LL");
			
			_.each(item.attributes.posts, function(post) {
				var date = new Date(parseFloat(post.tdate)*1000);
				post.time = moment(date.toISOString()).format("LT");
				post.location = post.position.split(",");
				
				$.ajax({
					url: "http://maps.googleapis.com/maps/api/geocode/json",
					type: "GET",
					async: false,
					data: {
						latlng: post.location[0] + "," + post.location[1],
						sensor: false
					},
					success: function(data) {
						post.address = data.results[0].formatted_address;
					}
				});
				
				var marker = new google.maps.Marker({
					position: strtocoord(post.position),
					map: this.my_map,
					opacity: 0.2
				});
				
				post.marker = markerlist.length;
				markerlist.push(marker);
				
				google.maps.event.addListener(marker, "click", (function(marker, item) {
					return function() {
						recenter(_.indexOf(markerlist, marker));
						$.scrollTo($(".post[data-marker-id='" + _.indexOf(markerlist, marker) + "']").offset().top - 100, 100);
					}
				})(marker, item));
				
			}, this);
			
			var dayView = new DayView({
				model: item
			});
			
			this.$el.append(dayView.render().el);
			recenter(parseFloat($(".post").first().attr("data-marker-id")));
		}
	});
	
	var trip = new TripView();
});

$(window).resize(function () {
	$(".gmaps-canvas").width($(".gmaps-canvas-placeholder").width()).css("right", $(".container").css("margin-right"));
	$("#gmaps-canvas").height($(window).height() - $(".gmaps-canvas").offset().top + window.pageYOffset - 50);
	recenter(cplaceview);
});

$(window).resize();