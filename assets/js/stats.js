
'use strict'
jQuery(document).ready(function($) {

  let map = function () {
    console.log("map");
    google.charts.load('current', {
       'packages': ['geochart'],
       'mapsApiKey': 'AIzaSyAUbmUVr7LSMCygtgzz1gIVACvSE-teDgs'
     });
     google.charts.setOnLoadCallback(drawMarkersMap);

    function drawMarkersMap() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Latitude');
      data.addColumn('number', 'Longitude')
      data.addRows(
        wpApiSettings.locations
      )


      var options = {
        tooltip: {trigger:"none"},
        region: 'US',
        title: "Location of each group",
        displayMode: 'markers',
        defaultColor: '#000ef5',
        backgroundColor: "#caf8ff",
        magnifyingGlass: {enable:false},

      };

      var chart = new google.visualization.GeoChart(document.getElementById('group-markers'));
      chart.draw(data, options);
    }
  }
  if (wpApiSettings.locations){
    map()
  }

  let group_sizes = function () {
    google.charts.load("current", {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable(wpApiSettings.sizes);

      var view = new google.visualization.DataView(data);

      var options = {
        bars: 'horizontal',
        title: "Number of groups according to their member count",
        legend: {position: "none"},
      };
      var chart = new google.visualization.BarChart(document.getElementById("sizes"));
      chart.draw(view, options)
    }
  }
  if(wpApiSettings.sizes){
    group_sizes()
  }

  let group_progress = function () {
    google.charts.load("current", {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable(wpApiSettings.steps);

      var view = new google.visualization.DataView(data);

      var options = {
        bars: 'horizontal',
        title: "Number of groups completing each session",
        legend: {position: "none"},
      };
      var chart = new google.visualization.BarChart(document.getElementById("sessions"));
      chart.draw(view, options)
    }
  }
  if(wpApiSettings.steps) {
    group_progress()
  }
})
