$(function() {
    "use strict"; 

    $(document).ready(function() {

        $('#calendar1').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            // Set the default date to the current date
            defaultDate: moment().format('YYYY-MM-DD'),
            navLinks: true, // Enable clickable day/week names to navigate views
            editable: true,
            eventLimit: true, // Allow "more" link when too many events

            // Sample events with updated dates
            events: [
                {
                    title: 'All Day Event',
                    start: moment().startOf('month').format('YYYY-MM-DD') // First day of the current month
                },
                {
                    title: 'Long Event',
                    start: moment().date(7).format('YYYY-MM-DD'), // 7th day of current month
                    end: moment().date(10).format('YYYY-MM-DD') // 10th day of current month
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: moment().date(9).hour(16).format('YYYY-MM-DDTHH:mm:ss'),
                    backgroundColor: '#ffc108',
                    borderColor: '#ffc108'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: moment().date(16).hour(16).format('YYYY-MM-DDTHH:mm:ss'),
                    backgroundColor: '#ffc108',
                    borderColor: '#ffc108'
                },
                {
                    title: 'Conference',
                    start: moment().date(11).format('YYYY-MM-DD'),
                    end: moment().date(13).format('YYYY-MM-DD'),
                    backgroundColor: '#ff407b',
                    borderColor: '#ff407b'
                },
                {
                    title: 'Meeting',
                    start: moment().date(12).hour(10).minute(30).format('YYYY-MM-DDTHH:mm:ss'),
                    end: moment().date(12).hour(12).minute(30).format('YYYY-MM-DDTHH:mm:ss'),
                    backgroundColor: '#25d5f2',
                    borderColor: '#25d5f2'
                },
                {
                    title: 'Lunch',
                    start: moment().date(12).hour(12).format('YYYY-MM-DDTHH:mm:ss'),
                    backgroundColor: '#ff407b',
                    borderColor: '#ff407b'
                },
                {
                    title: 'Meeting',
                    start: moment().date(12).hour(14).minute(30).format('YYYY-MM-DDTHH:mm:ss'),
                    backgroundColor: '#25d5f2',
                    borderColor: '#25d5f2'
                },
                {
                    title: 'Happy Hour',
                    start: moment().date(12).hour(17).minute(30).format('YYYY-MM-DDTHH:mm:ss')
                },
                {
                    title: 'Dinner',
                    start: moment().date(12).hour(20).format('YYYY-MM-DDTHH:mm:ss')
                },
                {
                    title: 'Birthday Party',
                    start: moment().date(13).hour(7).format('YYYY-MM-DDTHH:mm:ss'),
                    backgroundColor: '#ef172c',
                    borderColor: '#ef172c'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: moment().date(28).format('YYYY-MM-DD'),
                    backgroundColor: '#4285F4',
                    borderColor: '#4285F4'
                }
            ]
        });

    });
  
   
    $(document).ready(function() {


        /* initialize the external events
        -----------------------------------------------------------------*/

        $('#external-events .fc-event').each(function() {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });

        });


        /* initialize the calendar
        -----------------------------------------------------------------*/

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            }
        });


    });


 });