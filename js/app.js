function strtocoord(str){
	return {lat: parseFloat(str.split(",")[0]), lng: parseFloat(str.split(",")[1])};
}