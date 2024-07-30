$(document).ready(function() {



  $.get("http://localhost/GestionPesonnel/page/ViewConge.php/getAgenda",function(data){
    console.log(JSON.parse(data));
    var now =new Date () ;
                mo=now.getMonth() +1;
                dname=now.getDate()
                yr=now.getFullYear();
    now = yr +'-'+ mo +'-'+ dname;
    afficherAngenda(JSON.parse(data), now);
  })
  

  function afficherAngenda(array, now){
    $('#calendar').fullCalendar({

      header: {

        left: 'prev,next today',

        center: 'title',

        right: 'month,agendaWeek,agendaDay'

      },

      defaultDate: now,

      navLinks: true, // can click day/week names to navigate views

      selectable: true,

      selectHelper: true,

      select: function(start, end) {

        var title = prompt('Event Title:');

        var eventData;

        if (title) {

          eventData = {

            title: title,

            start: start,

            end: end

          };

          $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true

        }

        $('#calendar').fullCalendar('unselect');

      },

      editable: false,

      eventLimit: false, // allow "more" link when too many events

      events: array

    });


  }
   

  });