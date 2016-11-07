   <nav aria-label="Page navigation">
            <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
                <?php for($i=1; $i<10; $i++): 
                    $isActive = '';
                    if(ump_get_current_page() == $i) { 
                        $isActive = 'active';
                    } 
                ?>  
                    <li class="<?php print $isActive; ?>"><a href="?section=message-notification&tab=umbrella-partners&page=<?php print $i; ?>"><?php print $i; ?></a></li> 
                <?php endfor; ?>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
          </ul>
        </nav>