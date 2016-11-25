<html lang="en">
<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Bootply snippet - Bootstrap Gmail inbox</title>
        <meta name="generator" content="Bootply">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Bootstrap Gmail inbox example snippet for Bootstrap.">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        <!-- CSS code from Bootply.com editor -->  
        <style type="text/css">
            /* CSS used here will be applied after bootstrap.css */ 
            body{ margin-top:50px;}
            .nav-tabs .glyphicon:not(.no-margin) { margin-right:10px; }
            .tab-pane .list-group-item:first-child {border-top-right-radius: 0px;border-top-left-radius: 0px;}
            .tab-pane .list-group-item:last-child {border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;}
            .tab-pane .list-group .checkbox { display: inline-block;margin: 0px; }
            .tab-pane .list-group input[type="checkbox"]{ margin-top: 2px; }
            .tab-pane .list-group .glyphicon { margin-right:5px; }
            .tab-pane .list-group .glyphicon:hover { color:#FFBC00; }
            a.list-group-item.read { color: #222;background-color: #F3F3F3; }
            hr { margin-top: 5px;margin-bottom: 10px; }
            .nav-pills>li>a {padding: 5px 10px;} 
            .ad { padding: 5px;background: #F5F5F5;color: #222;font-size: 80%;border: 1px solid #E5E5E5; }
            .ad a.title {color: #15C;text-decoration: none;font-weight: bold;font-size: 110%;}
            .ad a.url {color: #093;text-decoration: none;}
        </style>
    <style type="text/css">/* This is not a zero-length file! */</style><style type="text/css">/* This is not a zero-length file! */</style></head> 
    <!-- HTML code from Bootply.com editor --> 
    <body> 
  	<div class="container">
     
    <div class="row">
        <div class="col-sm-3 col-md-2"> 
            <a href="#" class="btn btn-danger btn-sm btn-block" role="button"><i class="glyphicon glyphicon-edit"></i> 
            	Compose Ticket
            </a> 
            <hr>
            <ul class="nav nav-pills nav-stacked">
                <li class="active">
                	<a href="#">
                		<span class="badge pull-right">32</span> Inbox 
                	</a>
                </li>  
            </ul>
        </div>
        <div class="col-sm-9 col-md-10"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active">
                	<a href="#home" data-toggle="tab">  
                		<span class="badge pull-left">6</span> &nbsp; 
                		Business Growth Executive
                	</a>
                </li>
                <li>
                	<a href="#profile" data-toggle="tab">
                		<span class="badge pull-left">2</span> &nbsp;  
                    	Umbrella Messages
                    </a>
                </li>
                <li>
                	<a href="#messages" data-toggle="tab">
                		<span class="badge pull-left">3</span> &nbsp; 
                		Umbrella Partners
                    </a>
              	</li> 
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="min-height: 50%;border: 1px solid #dddddd;background-color: #fdfdfd;" >

            	<!-- Tab 1 -->
                <div class="tab-pane fade in active" id="home">
                    <div class="list-group">   

                    	<!-- unread ticket -->
                  		<a href="#" class="list-group-item read"> 
                            <i class="fa fa-envelope"> </i> 
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                </label>
                            </div> 
        		 			<b> 
                       			<span class="name" style="min-width: 120px;display: inline-block;">Jesus Erwin Suarez</span>
                        		<span class="">This is the subject of the message</span>
	                            <span class="text-muted" style="font-size: 11px;">This is the latest message </span> 
                            </b>
                            <span class="badge">2 ago</span> 
                            <span class="pull-right"> 
                            </span>
                        </a>      
						
						<!-- read ticket -->
                    	<a href="#" class="list-group-item"> 
                            <i class="fa fa-envelope-open"> </i> 
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                </label>
                            </div>  
                   			<span class="name" style="min-width: 120px;display: inline-block;">Jesus Erwin Suarez</span>
                    		<span class="">This is the subject of the message</span>
                            <span class="text-muted" style="font-size: 11px;">This is the latest message </span>  
                            <span class="badge">2 ago</span> 
                            <span class="pull-right"> 
                            </span>
                        </a>    
                    </div> 
                </div> 
                <div class="tab-pane fade in" id="profile">
 					<div class="list-group">   
                    
                    	<!-- unread ticket -->
                  		<a href="#" class="list-group-item read"> 
                            <i class="fa fa-envelope"> </i> 
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                </label>
                            </div> 
        		 			<b> 
                       			<span class="name" style="min-width: 120px;display: inline-block;">Jesus Erwin Suarez 1</span>
                        		<span class="">This is the subject of the message</span>
	                            <span class="text-muted" style="font-size: 11px;">This is the latest message </span> 
                            </b>
                            <span class="badge">2 ago</span> 
                            <span class="pull-right"> 
                            </span>
                        </a>      
						
						<!-- read ticket -->
                    	<a href="#" class="list-group-item"> 
                            <i class="fa fa-envelope-open"> </i> 
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                </label>
                            </div>  
                   			<span class="name" style="min-width: 120px;display: inline-block;">Jesus Erwin Suarez 2</span>
                    		<span class="">This is the subject of the message</span>
                            <span class="text-muted" style="font-size: 11px;">This is the latest message </span>  
                            <span class="badge">2 ago</span> 
                            <span class="pull-right"> 
                            </span>
                        </a>    
                    </div> 
                </div>

                <!-- Tab 2 -->
                <div class="tab-pane fade in" id="messages">
               			<div class="list-group">   
                    
                    	<!-- unread ticket -->
                  		<a href="#" class="list-group-item read"> 
                            <i class="fa fa-envelope"> </i> 
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                </label>
                            </div> 
        		 			<b> 
                       			<span class="name" style="min-width: 120px;display: inline-block;">Jesus Erwin Suarez 3</span>
                        		<span class="">This is the subject of the message</span>
	                            <span class="text-muted" style="font-size: 11px;">This is the latest message </span> 
                            </b>
                            <span class="badge">2 ago</span> 
                            <span class="pull-right"> 
                            </span>
                        </a>      
						
						<!-- read ticket -->
                    	<a href="#" class="list-group-item"> 
                            <i class="fa fa-envelope-open"> </i> 
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                </label>
                            </div>  
                   			<span class="name" style="min-width: 120px;display: inline-block;">Jesus Erwin Suarez 4</span>
                    		<span class="">This is the subject of the message</span>
                            <span class="text-muted" style="font-size: 11px;">This is the latest message </span>  
                            <span class="badge">2 ago</span> 
                            <span class="pull-right"> 
                            </span>
                        </a>    
                    </div>
               	</div>
				
				<!-- Tab 3 -->
                <div class="tab-pane fade in" id="settings">
                    This tab is empty.
              	</div>
            </div> 
            <div class="row-md-12"> 
                <div>  
                    <nav aria-label="...">
                        <ul class="pagination pagination-sm" style="padding: 0px;margin-top: 0px;">
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Previous</span>
                            </a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                              <span class="sr-only">Next</span>
                            </a>
                          </li>
                        </ul>
                      </nav>
                </div> 
            </div>
        </div>
    </div>
</div> 
    <script async="" src="//www.google-analytics.com/analytics.js"></script><script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>  
</body>
</html>