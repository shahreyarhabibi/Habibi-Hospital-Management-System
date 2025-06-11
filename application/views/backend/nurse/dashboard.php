<div class="row">
    <!-- CALENDAR-->
    <div class="col-md-12 col-xs-12">    
        <div class="panel panel-primary " data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="fa fa-calendar"></i>
                    <?php echo get_phrase('event_schedule'); ?>
                </div>
            </div>
            <div class="panel-body" style="padding:0px;">
                <div class="calendar-env">
                    <div class="calendar-body">
                        <div id="notice_calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function()
    {
        $('#notice_calendar').fullCalendar
        ({
            header:
            {
                left: 'title',
                right: 'month,agendaWeek,agendaDay today prev,next'
            },

            editable: false,
            firstDay: 1,
            height: 530,
            droppable: false,

            events: [
                <?php
                $notices = $this->db->get('notice')->result_array();
                foreach ($notices as $row):
                    // Prepare event data for JSON encoding
                    $event = [
                        'title' => $row['title'],
                        'start' => date('Y-m-d', $row['start_timestamp']),
                        'end' => date('Y-m-d', $row['end_timestamp']),
                        'allDay' => true,
                        'description' => $row['description']
                    ];
                    echo json_encode($event, JSON_UNESCAPED_UNICODE);
                    echo ",";
                endforeach;
                ?>
            ],

            eventClick: function(calEvent) {
                if (calEvent.description) {
                    alert(calEvent.title + "\n\n" + calEvent.description);
                } else {
                    alert(calEvent.title);
                }
            }
        });
    });
</script>
