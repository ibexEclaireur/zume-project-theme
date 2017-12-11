
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
        defaultColor: '#21336A',
        backgroundColor: "#2cace2",
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
  if(wpApiSettings.analytics){
    $('#analytics').text(wpApiSettings.analytics)
  }
  if(wpApiSettings.intro_views){
    $("#intro_views").text(wpApiSettings.intro_views)
  }


  let table = $("#coaches-table > tbody:last-child");
  let filterCoachesTable = function (groups) {
    $("#coaches-table tbody").empty()
    groups.forEach(group=>{
      table.append(`
        <tr>
          <td>${group.name || ""}</td>
          <td>${group.email}</td>
          <td>${group.address || ""}</td>
          <td>${group.state || ""}</td>
          <td>${group.member_count || ""}</td>
          <td>${group.session || ""}</td>
        </tr>
      `)
    })

  }
  if(wpApiSettings.coach_groups){
    filterCoachesTable(wpApiSettings.coach_groups)
  }

  $("#state-select").on("change", function () {
    let selected = this.value
    let groups = [];
    if (selected && selected != "all"){
      groups = wpApiSettings.coach_groups.filter(group=>group.state==selected)
    } else {
      groups = wpApiSettings.coach_groups
    }
    filterCoachesTable(groups)
  })
})
