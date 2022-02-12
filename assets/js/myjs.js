
    var i=1;  
    $('#addenquiry').click(function(){ 
            //alert('a');        
           i++;  
           str='<div id="enquiry'+i+'">'+
               '<br />'+
               '<div class="row">'+               
               '<div class="col-12 col-md-2">'+
               '<label class="m-t-20">Enquiry Date</label>'+
               '<input type="text" class="form-control cquiry_date" placeholder="Enter Enquiry Date" id="cq_date" name="cq_date[]" value="">'+
               '</div>'+
               '<div class="col-12 col-md-2">'+
               '<label class="m-t-20">Enquiry Time</label>'+
               '<input type="text" class="form-control cquiry_time" placeholder="Enter Enquiry Time" id="cq_time" name="cq_time[]" value="">'+
               '</div>'+
               '<div class="col-12 col-md-7">'+
               '<label class="m-t-20">Enquiry Details</label>'+               
               '<textarea class="form-control" placeholder="Enter Enquiry Details" id="cq_enquiry" name="cq_enquiry[]" rows="3"></textarea>'+
               '</div>'+               
               '<div class="col-12 col-md-1">'+
               '<label class="m-t-20">Remove</label>'+
               '<button type="button" name="remove" id="enquiry'+i+'" class="btn btn-danger btn-sm btn_remove">Remove</button>'+
               '</div>'+                
               '</div>';
               '</div>'+
           $('#dynamic_field').append(str);  

           // MAterial Date picker    
          $('.cquiry_date').bootstrapMaterialDatePicker({ 
            weekStart: 0, 
            time: false,
            format: 'DD-MMMM-YYYY'
            });

            $('.cquiry_time').bootstrapMaterialDatePicker({ 
                weekStart: 0, 
                date:false,
                time: true,
                format: 'HH:mm',
                twelvehour: false
                });

      }); 

       
      $(document).on('click', '.btn_remove', function(){            
           var button_id = $(this).attr("id");   
           $('#'+button_id+'').remove();  
      });  
      

      $('#Others').hide();
      $('#m_subject').on('change', function() {
        var value = $(this).val();
        //alert(value);
        if(value=="23"){
            $('#Others').show();
        }
        else{
            $('#Others').hide();
        }
      });

      $('#editOthers2').hide();
      $('#m_subject').on('change', function() {
        var value = $(this).val();
        //alert(value);
        if(value=="23"){
            $('#editOthers').show();
            $('#editOthers2').show();
        }
        else{
            $('#editOthers').hide();
            $('#editOthers2').hide();
        }
      });

      // MAterial Date picker   
       
// MAterial Date picker    
$('.cquiry_date').bootstrapMaterialDatePicker({ 
    weekStart: 0, 
    time: false,
    format: 'DD-MMMM-YYYY'
    });

    $('.cquiry_time').bootstrapMaterialDatePicker({ 
    weekStart: 0, 
    date:false,
    time: true,
    format: 'HH:mm',
    twelvehour: false
    });
    

  //Custom design form example
  $(".tab-wizard").steps({
    headerTag: "h6",
    bodyTag: "section",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: "Submit"
    },
    onFinished: function(event, currentIndex) {
        swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");

    }
});



// Visualization API with the 'corechart' package.
google.charts.load('current', { packages: ['corechart','bar','orgchart','calendar'] });
google.charts.setOnLoadCallback(drawLineChart);
google.charts.setOnLoadCallback(drawLineChart2);
google.charts.setOnLoadCallback(drawLineChart3);
google.charts.setOnLoadCallback(drawLineChart4);
google.charts.setOnLoadCallback(drawLineChart10);
google.charts.setOnLoadCallback(drawLineChart11);
google.charts.setOnLoadCallback(drawPieChart);

//google.charts.setOnLoadCallback(drawOrgChart);
google.charts.setOnLoadCallback(drawCalendarChart);


//for current month
google.charts.setOnLoadCallback(drawLineChart5);
google.charts.setOnLoadCallback(drawLineChart6);
google.charts.setOnLoadCallback(drawLineChart7);
google.charts.setOnLoadCallback(drawPieChart2);
//for current month

//Search between date
$("#search_submit").click(function()
{
    google.charts.setOnLoadCallback(drawLineChart8); // complain dispose pending
    google.charts.setOnLoadCallback(drawLineChart9); // nature
    google.charts.setOnLoadCallback(drawPieChart3);  // pie chart
});

//google.charts.setOnLoadCallback(drawPieChart3);  // pie chart
//Search between date


function drawLineChart() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printComplainGraph",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //alert(data);            
            var arrSales = [['Month', 'No Of Complains']];    // Define an array and assign columns for the chart.
            // Loop through each data and populate the array.
            $.each(data, function (index, value) {
                //alert(value.mt_date);
                //alert(value.c_c);
                arrSales.push([value.t_month+','+value.year, parseInt(value.c_c)]);
            });
            // Set chart Options.
            var options = {
                chart: {
                    title: 'Complain Status',                    
                  },
                  colors: ['#7460ee'],
                  legend: {
                    position: 'none'
                  },
                  chartArea: {
                    height: '350',
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                },                                              
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales);
            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.charts.Bar(document.getElementById('curve_chart'));                        

            //
            google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    //document.redirect('google.com');
                    //alert(data);
                    //console.log(data[row].mt_date);
                    var month=data[row].mt_date;
                    var year=data[row].year;
                    var tab='Complain';
                    var catergory='all';
                    var disposed='all';
                    window.open('chartDetails/'+tab+'/'+catergory+'/'+month+'/'+year+'/'+disposed);
                }}
            );
            //

            chart.draw(figures, options);      // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
           // alert('Got an Error');
        }
    });
}

function drawLineChart2() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printDisposedGraph",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //alert(data);            
            var arrSales = [['Month', 'No Of Disposed Complains']];    // Define an array and assign columns for the chart.
            // Loop through each data and populate the array.
            $.each(data, function (index, value) {
                //alert(value.mt_date);
                //alert(value.c_c);
                arrSales.push([value.t_month+','+value.year, parseInt(value.c_c)]);
            });
            // Set chart Options.
            var options = {
                chart: {
                    title: 'Disposed Status',                    
                  },
                  colors: ['#22c6ab'],
                  legend: {
                    position: 'none'
                  },
                  chartArea: {
                    height: '350',
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                },                                              
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales)
            
            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.charts.Bar(document.getElementById('curve_chart2'));            
             //
             google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    //document.redirect('google.com');
                    //alert(data);
                    //console.log(data[row].mt_date);
                    var month=data[row].mt_date;
                    var year=data[row].year;
                    var tab='Complain';
                    var catergory='all';
                    var disposed='yes';
                    window.open('chartDetails/'+tab+'/'+catergory+'/'+month+'/'+year+'/'+disposed);
                }}
            );
            //
            chart.draw(figures, options);      // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
           // alert('Got an Error');
        }
    });
}

function drawLineChart3() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printPendingGraph",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //alert(data);            
            var arrSales = [['Month', 'No Of Pending Complains']];    // Define an array and assign columns for the chart.
            // Loop through each data and populate the array.
            $.each(data, function (index, value) {
                //alert(value.mt_date);
                //alert(value.c_c);
                arrSales.push([value.t_month+','+value.year, parseInt(value.c_c)]);
            });
            // Set chart Options.
            var options = {
                chart: {
                    title: 'Pending Complain Status',                    
                  },
                  colors: ['#ef6e6e'],
                  legend: {
                    position: 'none'
                  },
                  chartArea: {
                    height: '350',
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                },                                     
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales)
            
            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.charts.Bar(document.getElementById('curve_chart3'));            
             //
             google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    //document.redirect('google.com');
                    //alert(data);
                    //console.log(data[row].mt_date);
                    var month=data[row].mt_date;
                    var year=data[row].year;
                    var tab='Complain';
                    var catergory='all';
                    var disposed='no';
                    window.open('chartDetails/'+tab+'/'+catergory+'/'+month+'/'+year+'/'+disposed);
                }}
            );
            //
            chart.draw(figures, options);      // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
           // alert('Got an Error');
        }
    });
}

function drawLineChart4() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printCompainNature",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //alert(data);            
            var arrSales = [['Nature of Complaints', 'Nature of Complaint']];    // Define an array and assign columns for the chart.
            // Loop through each data and populate the array.
            $.each(data, function (index, value) {
                //alert(value.mt_subject);
                //alert(value.c_c);
                arrSales.push([value.cn_name, parseInt(value.c_c)]);
            });
            // Set chart Options.
            var options = {
                chart: {
                    title: 'Nature of Complaint',                    
                  },
                  legend: {
                    position: 'none'
                  },
                  chartArea: {
                    height: '350',
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                },                                     
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales)
            
            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.charts.Bar(document.getElementById('curve_chart4'));            

             //
            google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    //document.redirect('google.com');
                    //alert(data);
                    //console.log(data[row].mt_date);
                    console.log(data[row]);
                    var month='mon';
                    var year='year';
                    var tab='ComplainNature';
                    var category='all';
                    var disposed=data[row].cn_name;
                    window.open('chartDetails/'+tab+'/'+category+'/'+month+'/'+year+'/'+disposed);
                }}
            );
            //

            chart.draw(figures, options);      // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
           // alert('Got an Error');
        }
    });
}

function drawLineChart5() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printComplainDisposedPendingGraph",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //alert(data);            
            var arrSales = [['Month', 'Complain','Disposed', 'Pending']];    // Define an array and assign columns for the chart.
            // Loop through each data and populate the array.
            $.each(data, function (index, value) {
                //alert(value.mt_subject);
                //alert(value.c_c);
                arrSales.push([value.t_month+','+value.year, parseInt(value.c_c),parseInt(value.c_d),parseInt(value.c_p)]);
            });
            // Set chart Options.
            var options = {
                chart: {
                    title: 'Complaint, Disposed, Pending Status',                    
                  },
                  colors: ['#7460ee','#22c6ab','#ef6e6e'],
                  legend: {
                    position: 'none'
                  },
                  chartArea: {
                    height: '350',
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                },                                     
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales)
            
            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.charts.Bar(document.getElementById('curve_chart5'));              
            chart.draw(figures, options);      // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
           // alert('Got an Error');
        }
    });
}

function drawLineChart6() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printCurrentMonthComplainDisposedPendingGraph",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //alert(data);            
            var arrSales = [['This Month', 'Complaint','Disposed', 'Pending']];    // Define an array and assign columns for the chart.
            // Loop through each data and populate the array.
            $.each(data, function (index, value) {
                //alert(value.t_month);
                //alert(value.c_c);
                arrSales.push([value.t_month+','+value.year, parseInt(value.c_c),parseInt(value.c_d),parseInt(value.c_p)]);
            });
            // Set chart Options.
            var options = {
                chart: {
                    title: 'This Month Complaint, Disposed, Pending Status',                    
                  },
                  colors: ['#7460ee','#22c6ab','#ef6e6e'],
                  legend: {
                    position: 'none'
                  },
                  chartArea: {
                    height: '350',
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                },                                     
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales)
            
            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.charts.Bar(document.getElementById('curve_chart6'));            
            //
            google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                
                if (selection.length) {
                    var row = selection[0].row;
                    var col = selection[0].column;

                    //document.redirect('google.com');
                    //alert(data);                    
                    //console.log(row);
                    //console.log(col);
                    var month=data[row].t_month;
                    var year=data[row].year;
                    var tab='Complain';
                    var category='current';

                    if(col==1)
                    {
                        disposed='all';
                    }
                    if(col==2)
                    {
                        disposed='yes';
                    }
                    if(col==3)
                    {
                        disposed='no';
                    }
                    //console.log(month);
                    window.open('chartDetails/'+tab+'/'+category+'/'+month+'/'+year+'/'+disposed);
                }}
            );
            //
            chart.draw(figures, options);      // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
           // alert('Got an Error');
        }
    });
}

function drawLineChart7() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printCurrentMonthCompainNature",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //alert(data);            
            var arrSales = [['Nature of Complaints', 'Nature of Complaints']];    // Define an array and assign columns for the chart.
            // Loop through each data and populate the array.
            $.each(data, function (index, value) {
                //alert(value.mt_subject);
                //alert(value.c_c);
                arrSales.push([value.mt_subject, parseInt(value.c_c)]);
            });
            // Set chart Options.
            var options = {
                chart: {
                    title: 'Nature of Complaints This Month',                    
                  },
                  legend: {
                    position: 'none'
                  },
                  chartArea: {
                    height: '350',
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                },                                     
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales)
            
            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.charts.Bar(document.getElementById('curve_chart7'));
            
            //
            google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    //document.redirect('google.com');
                    //alert(data);
                    //console.log(data[row].mt_date);
                    //console.log(data[row]);
                    var month='mon';
                    var year='year';
                    var tab='ComplainNature';
                    var category='current';
                    var disposed=data[row].mt_subject;
                    window.open('chartDetails/'+tab+'/'+category+'/'+month+'/'+year+'/'+disposed);
                }}
            );
            //

            chart.draw(figures, options);      // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
           // alert('Got an Error');
        }
    });
}

function drawLineChart8() {
    var date1=$('#date1').val();
    var date2=$('#date2').val();

    //alert(date1);
    //alert(date2);

    
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printBetweenDateComplainDisposedPendingGraph?date1="+date1+"&date2="+date2,      
        dataType: "json",
        type: "GET",              
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //alert(data);            
            var arrSales = [['Month', 'Complain','Disposed', 'Pending']];    // Define an array and assign columns for the chart.
            // Loop through each data and populate the array.
            $.each(data, function (index, value) {
                //alert(value.t_month);
                //alert(value.c_c);
                arrSales.push([value.t_month, parseInt(value.c_c),parseInt(value.c_d),parseInt(value.c_p)]);
            });
            // Set chart Options.
            var options = {
                chart: {
                    title: 'Complaint, Disposed, Pending Status',                    
                  },
                  colors: ['#7460ee','#22c6ab','#ef6e6e'],
                  legend: {
                    position: 'none'
                  },
                  chartArea: {
                    height: '350',
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                },                                     
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales)
            
           
            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.charts.Bar(document.getElementById('curve_chart8'));            

              //
            google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                
                if (selection.length) {
                    var row = selection[0].row;
                    var col = selection[0].column;

                    //document.redirect('google.com');
                    //alert(data);                    
                    //console.log(data);
                    
                    //console.log(col);
                    var month=data[row].t_month;
                    var year=data[row].year;
                    if(col==1)
                    {
                        disposed='all';
                    }
                    if(col==2)
                    {
                        disposed='yes';
                    }
                    if(col==3)
                    {
                        disposed='no';
                    }
                    //console.log(month);
                    window.open('chartDetails2/'+date1+'/'+date2+'/'+disposed);
                }}
            );
            //
            chart.draw(figures, options);      // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Got an Error'+ errorThrown);
        }
    });
    
}

function drawLineChart9() {
    var date1=$('#date1').val();
    var date2=$('#date2').val();

    //alert(date1);
    //alert(date2);

    
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printBetweenDateCompainNature?date1="+date1+"&date2="+date2,      
        dataType: "json",
        type: "GET",              
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //alert(data);            
            var arrSales = [['Nature of Complaints', 'Nature of Complaints']];    // Define an array and assign columns for the chart.
            // Loop through each data and populate the array.
            $.each(data, function (index, value) {
                //alert(value.mt_subject);
                //alert(value.c_c);
                arrSales.push([value.mt_subject, parseInt(value.c_c)]);
            });
            // Set chart Options.
            var options = {
                chart: {
                    title: 'Nature of Complaints Status',                    
                  },
                  colors: ['#7460ee','#22c6ab','#ef6e6e'],
                  legend: {
                    position: 'none'
                  },
                  chartArea: {
                    height: '350',
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                },                                     
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales)
            
            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.charts.Bar(document.getElementById('curve_chart9'));            
            //
            google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                
                if (selection.length) {
                    var row = selection[0].row;
                    var col = selection[0].column;
                   
                    //document.redirect('google.com');
                    //alert(data);                    
                    //console.log(data);
                    
                    console.log(data);
                    //var month=data[row].mt_disposed;
                    //var year=data[row].year;                                        
                    var subject=data[row].mt_subject;
                    //console.log(month);
                    window.open('chartDetails3/'+date1+'/'+date2+'/'+subject);
                }}
            );
            //
            chart.draw(figures, options);      // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Got an Error'+ errorThrown);
        }
    });
    
}


function drawLineChart10() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printCompainDutyOfficer",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //alert(data);            
            var arrSales = [['Duty Officer', 'No Of Complaints', 'Disposed', 'Pending']];    // Define an array and assign columns for the chart.
            // Loop through each data and populate the array.
            $.each(data, function (index, value) {
                //alert(value.mt_date);
                //alert(value.c_c);
                arrSales.push([value.do_name+' , '+value.u_title, parseInt(value.c_c),parseInt(value.c_d),parseInt(value.c_p)]);
            });
            // Set chart Options.
            var options = {
                chart: {
                    title: 'Duty Officer wise Complaint Status',                    
                  },
                  colors: ['#7460ee','#22c6ab','#ef6e6e'],
                  legend: {
                    position: 'none'
                  },
                  chartArea: {
                    height: '350',
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                },                                              
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales);
            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.charts.Bar(document.getElementById('curve_chart10'));                        

            
            google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    var col = selection[0].column;
                    //document.redirect('google.com');
                    //alert(data);
                    //console.log(data[row].do_name); 
                    //console.log(selection[0]); 
                    var disposed='';
                    if(col==1)
                    {
                        disposed='all';
                    }
                    if(col==2)
                    {
                        disposed='yes';
                    }
                    if(col==3)
                    {
                        disposed='no';
                    }
                    var tab='Complain';
                    var doname=data[row].do_name;
                    window.open('chartDetails4/'+doname+'/'+disposed);
                }}
            );
            chart.draw(figures, options);      // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
           // alert('Got an Error');
        }
    });
}

function drawLineChart11() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printComplainDivisionGraph",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //alert(data);            
            var arrSales = [['Division', 'No Of Complains','Disposed', 'Pending']];    // Define an array and assign columns for the chart.
            // Loop through each data and populate the array.
            $.each(data, function (index, value) {
                //alert(value.mt_date);
                //alert(value.c_c);
                arrSales.push([value.u_title, parseInt(value.c_c), parseInt(value.c_d), parseInt(value.c_p)]);
            });
            // Set chart Options.
            var options = {
                chart: {
                    title: 'Division wise Complaint Status',                    
                  },
                  colors: ['#7460ee','#22c6ab','#ef6e6e'],
                  legend: {
                    position: 'none'
                  },
                  chartArea: {
                    height: '350',
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                },                                              
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales);
            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.charts.Bar(document.getElementById('curve_chart11'));                        

            /*
            google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    var col = selection[0].column;
                    //document.redirect('google.com');
                    //alert(data);
                    //console.log(data[row].do_name); 
                    //console.log(selection[0]); 
                    var disposed='';
                    if(col==1)
                    {
                        disposed='all';
                    }
                    if(col==2)
                    {
                        disposed='yes';
                    }
                    if(col==3)
                    {
                        disposed='no';
                    }
                    var tab='Complain';
                    var doname=data[row].do_name;
                    window.open('chartDetails4/'+doname+'/'+disposed);
                }}
            );
            */
            chart.draw(figures, options);      // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
           // alert('Got an Error');
        }
    });
}

function drawPieChart() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printDisposePendingGraph",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {

            //alert(data);
            
            var arrSales = [['Date', 'No Of Complains']];    // Define an array and assign columns for the chart.

            // Loop through each data and populate the array.
            $.each(data, function (index, value) {

                //alert(value.c_c);

                arrSales.push([value.mt_disposed, parseInt(value.c_c)]);
            });

            // Set chart Options.
            var options = {
                title: 'Complaint Disposed Status',
                colors: ['#22c6ab','#ef6e6e'],
                curveType: 'function',
                is3D: true,
                legend: { position: 'bottom', textStyle: { color: '#555', fontSize: 14} }  // You can position the legend on 'top' or at the 'bottom'.
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales)

            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
             
            //
            google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    //document.redirect('google.com');
                    //alert(data);
                    //console.log(data[row]);
                    var month='all';
                    var year='all';
                    var tab='ComplainPie';
                    var catergory='all';
                    var disposed='';
                    if(data[row].mt_disposed=="Yes")
                    {
                        disposed='yes';
                    }
                    else
                    {
                        disposed='no';
                    }                    
                    window.open('chartDetails/'+tab+'/'+catergory+'/'+month+'/'+year+'/'+disposed);
                }}
            );
            //

            chart.draw(figures, options);      // Draw the chart with Options.
        },        
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //alert('Got an Error');
        }
    });
}

function drawPieChart2() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printCurrentMonthDisposePendingGraph",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {

            //alert(data);
            
            var arrSales = [['Date', 'No Of Complains']];    // Define an array and assign columns for the chart.

            // Loop through each data and populate the array.
            $.each(data, function (index, value) {

                //alert(value.c_c);

                arrSales.push([value.mt_disposed, parseInt(value.c_c)]);
            });

            // Set chart Options.
            var options = {
                title: 'This Month Complaint Disposed Status',
                colors: ['#ef6e6e','#22c6ab'],
                curveType: 'function',
                is3D: true,
                legend: { position: 'bottom', textStyle: { color: '#555', fontSize: 14} }  // You can position the legend on 'top' or at the 'bottom'.
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales)

            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.visualization.PieChart(document.getElementById('pie_chart2'));
             //
             google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    //document.redirect('google.com');
                    //alert(data);
                    //console.log(data[row]);
                    var month='all';
                    var year='all';
                    var tab='ComplainPie';
                    var catergory='current';
                    var disposed='';
                    if(data[row].mt_disposed=="Yes")
                    {
                        disposed='yes';
                    }
                    else
                    {
                        disposed='no';
                    }                    
                    window.open('chartDetails/'+tab+'/'+catergory+'/'+month+'/'+year+'/'+disposed);
                }}
            );
            //

            chart.draw(figures, options);      // Draw the chart with Options.
        },        
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //alert('Got an Error');
        }
    });
}

function drawPieChart3() {
    var date1=$('#date1').val();
    var date2=$('#date2').val();
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printBetweenDateDisposePendingGraph?date1="+date1+"&date2="+date2,
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {

            //alert(data);
            
            var arrSales = [['Date', 'No Of Complains']];    // Define an array and assign columns for the chart.

            // Loop through each data and populate the array.
            $.each(data, function (index, value) {

                //alert(value.c_c);

                arrSales.push([value.mt_disposed, parseInt(value.c_c)]);
            });

            // Set chart Options.
            var options = {
                title: 'This Month Complaint Disposed Status',
                colors: ['#22c6ab','#ef6e6e'],
                curveType: 'function',
                is3D: true,
                legend: { position: 'bottom', textStyle: { color: '#555', fontSize: 14} }  // You can position the legend on 'top' or at the 'bottom'.
            };

            // Create DataTable and add the array to it.
            var figures = google.visualization.arrayToDataTable(arrSales)

            // Define the chart type (LineChart) and the container (a DIV in our case).
            var chart = new google.visualization.PieChart(document.getElementById('pie_chart3'));
              //
              google.visualization.events.addListener(chart, 'select', function () {
                var selection = chart.getSelection();
                
                if (selection.length) {
                    var row = selection[0].row;
                    var col = selection[0].column;

                    //document.redirect('google.com');
                    //alert(data);                    
                    //console.log(data);
                    
                    //console.log(data);
                    //var month=data[row].mt_disposed;
                    //var year=data[row].year;                                        
                    if(data[row].mt_disposed=="Yes")
                    {
                        disposed='yes';
                    }
                    if(data[row].mt_disposed=="No")
                    {
                        disposed='no';
                    }
                    //console.log(month);
                    window.open('chartDetails2/'+date1+'/'+date2+'/'+disposed);
                }}
            );
            //
            chart.draw(figures, options);      // Draw the chart with Options.
        },        
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //alert('Got an Error');
        }
    });
}

function drawOrgChart() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printSectionGraph",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //alert(data);            
            var datatable = new google.visualization.DataTable();
            datatable.addColumn('string', 'PS');
            datatable.addColumn('string', 'Parent');      
            datatable.addColumn('string', 'Tooltip'); 


            $.each(data, function (index, value) {

                datatable.addRows([[value.ps,value.parent,value.ps],]);                
                  
            });
            //console.log(datatable);
            // Set chart Options.
            var options = {
                chart: {
                    title: 'Hierarchy',                    
                  },
                  colors: ['#7460ee'],
                  legend: {
                    position: 'none'
                  },                                                               
            };
            // Create the chart.
            var chart = new google.visualization.OrgChart(document.getElementById('org_chart'));
            chart.draw(datatable, options);      // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
           // alert('Got an Error');
        }
    });
}


function drawCalendarChart() {
    $.ajax({
        url: "https://scientificwing.kolkatapolice.org/Abhijog/Api/printComplainGraphByDate",
        dataType: "json",
        type: "GET",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn({ type: 'date', id: 'Date'});
            dataTable.addColumn({ type: 'number', id: 'Count Cases'});

            $.each(data, function (index, value) {
                //alert(value.mt_date);
                dataTable.addRows([[new Date(value.mt_date),parseInt(value.c_c)],]);                                  
            });
            var chart = new google.visualization.Calendar(document.getElementById('calendar_chart'));
            var options = {
                title: "",
                height: 500,                                
            };
            chart.draw(dataTable, options);   // Draw the chart with Options.
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) 
        {
           alert('Got an Error');
        }
    });
}


      