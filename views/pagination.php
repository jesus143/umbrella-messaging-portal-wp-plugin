<?php 
    require ('config.php');  
    // print "pagination temporary disabled";
    // exit;
    $_SESSION['tickets'] = ump_separate_to_tabs(Ump\UmpFd::fetchTickets('email', $_SESSION['ump_current_user_email'] )); 
    $tab = $_GET['tab'];  
    // print "tab " .    $tab ; 
    if($tab == 'Business Growth Executed') {  
        $tickets = $_SESSION['tickets']['umbrella_growth_executive'];      
        $content_id = '#ump-content-bge';
        // $tickets = ump_sort_ticket_by_unread_notification($tickets);  
    } else if ($tab == 'Umbrella Messages') {
        $tickets = $_SESSION['tickets']['umbrella_messages'];
        $content_id = '#ump-content-um';
        // $tickets = ump_sort_ticket_by_unread_notification($tickets);  
    }else if($tab == 'Umbrella Portners') {   
        // $tickets = '';
        print "<h1>Pagination Comming soon..</h1>";
         $tickets = $_SESSION['tickets']['umbrella_partners'];
        $content_id = '#ump-footer-um';
        exit;
    } 

    $totalPagination = ump_count_total_tickets_for_pagination($tickets, $_SESSION['ump_total_ticket_per_page']); 
    // print "total pagination now after loading " .     $totalPagination ;
?> 
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
                <?php for($i=1; $i<=$totalPagination; $i++): 
                    $isActive = '';
                    if(ump_get_current_page() == $i) { 
                        $isActive = 'active';
                    } else if(ump_get_current_page() < 1 and $i ==1) {
                        $isActive = 'active';
                    }
                ?>
                    <li class="<?php print $isActive; ?>" id="ump-pagination-<?php print $i; ?>" onClick="umpLoadContent('<?php print $content_id; ?>', '<?php print $tab; ?>', <?php print $i ?>, '#ump-pagination')">
                        <a href="#">
                            <?php print $i; ?>
                                
                        </a>
                    </li> 
                <?php endfor; ?>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>