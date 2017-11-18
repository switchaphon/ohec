<!-- page content -->
<article>
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
            <h3>Bottomline</h3>
            </div>

            <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                </span>
                </div>
            </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Basic Elements <small>different form elements</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    <?php
                        // require './third_party/bottomline/bottomline.php';
                        include APPPATH.'third_party/bottomline/bottomline.php';
                        $json_string = "{\"items\": [{\"id\": \"q01\",\"question\": \"Is this a question?\",\"answer_list\": [{\"id\": \"a01\",\"answer\": \"yes\",\"value\": true}, {\"id\": \"a02\",\"answer\": \"no\",\"value\": false}],\"status\": \"enable\",\"type\": \"radio\"}, {\"id\": \"q02\",\"question\":\"What is this a question?\",\"answer_list\": [],\"status\": \"enable\",\"type\": \"textbox\"}, {\"id\": \"q03\",\"question\": \"Select the required items (mutliple choice)\",\"answer_list\": [{\"id\": \"a03\",\"answer\": \"item 1\",\"value\": \"item 1\"}, {\"id\": \"a04\",\"answer\": \"item 2\",\"value\": \"item 2\"}, {\"id\": \"a05\",\"answer\": \"item 3\",\"value\": \"item 3\"}],\"status\": \"disable\",\"type\": \"checkbox\"}]}";
                        $json_object = json_decode($json_string);

                        echo __::first($json_object->items)->id; // = $json_object->items[0]->id
                        // echo __::filter($json_object, function($object) {
                        //         return $object['status'] == "enable";
                        //     }); // = array_slice($json_object->items, 0, 2) // item index 0 and 1 have enable status.
                        $a = [
                            ['name' => 'fred',   'age' => 32],
                            ['name' => 'maciej', 'age' => 16]
                        ];
                        
                        __::filter($a, function($n) {
                            echo $n['age'] > 24;
                        });
                        // >> [['name' => 'fred', 'age' => 32]]
                        $json_string2 ="
                        {
                            \"pages\": [
                             {
                              \"name\": \"page1\",
                              \"elements\": [
                               {
                                \"type\": \"panel\",
                                \"elements\": [
                                 {
                                  \"type\": \"matrix\",
                                  \"columns\": [
                                   \"Column 1\",
                                   \"Column 2\",
                                   \"Column 3\"
                                  ],
                                  \"name\": \"question1\",
                                  \"rows\": [
                                   \"Row 1\",
                                   \"Row 2\"
                                  ]
                                 },
                                 {
                                  \"type\": \"file\",
                                  \"name\": \"question2\"
                                 }
                                ],
                                \"name\": \"panel1\"
                               },
                               {
                                \"type\": \"panel\",
                                \"elements\": [
                                 {
                                  \"type\": \"matrix\",
                                  \"columns\": [
                                   \"Column 1\",
                                   \"Column 2\",
                                   \"Column 3\"
                                  ],
                                  \"name\": \"question3\",
                                  \"rows\": [
                                   \"Row 1\",
                                   \"Row 2\"
                                  ]
                                 },
                                 {
                                  \"type\": \"file\",
                                  \"name\": \"question4\"
                                 }
                                ],
                                \"name\": \"panel2\"
                               }
                              ]
                             }
                            ]
                           }";
                           $json_object2 = json_decode($json_string2); echo "xxx";
                           echo "<pre>"; print_r($json_object2); echo "</pre>";
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</artical>
<!-- /page content -->