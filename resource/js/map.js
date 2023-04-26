var example1, example2; //globals so we can manipulate them in the debugger
        $(function() {
            "use strict";
            var examples = $("svg").svgPanZoom();

            var callback= function(example) {
                return function(event) {
                    if ($(event.target).hasClass("fa-arrow-up"))
                        example.panUp()
                    if ($(event.target).hasClass("fa-arrow-down"))
                        example.panDown()
                    if ($(event.target).hasClass("fa-arrow-left"))
                        example.panLeft()
                    if ($(event.target).hasClass("fa-arrow-right"))
                        example.panRight()
                    if ($(event.target).hasClass("fa-plus"))
                        example.zoomIn()
                    if ($(event.target).hasClass("fa-minus"))
                        example.zoomOut()
                    if ($(event.target).hasClass("fa-refresh"))
                        example.reset()
                }
            };

            example1= examples[0]

            $("div#example1 i").click(callback(example1));

        }
        );

       
    