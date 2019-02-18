

$(function() {
	var Trip = Backbone.Model.extend({
		defaults: function() {
			return {
				image: "http://placehold.it/300x200"
			}
		}
	});
	
	var Trips = Backbone.Collection.extend({
		model: Trip
	});
	
	var TripView = Backbone.View.extend({
		tagName: "div",
		className: "col-sm-4 col-md-3",
		template: _.template($("#trip-template").html()),
		render: function() {
			this.$el.html(this.template(this.model.toJSON()));
			return this;
		}
	});
	
	var TripsView = Backbone.View.extend({
		el: $(".trips"),
		initialize: function() {
			this.collection = new Trips(trips);
			this.render();
		},
		render: function() {
			var that = this;
			_.each(this.collection.models, function(item) {
				that.renderTrip(item);
			}, this);
		},
		renderTrip: function(item) {
			var tripView = new TripView({
				model: item
			});
			this.$el.append(tripView.render().el);
		}
	});
	
	var alltrips = new TripsView();
});