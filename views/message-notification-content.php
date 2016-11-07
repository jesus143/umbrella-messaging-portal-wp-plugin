<div class="bs-example" data-example-id="list-group-custom-content">
    <div class="list-group">
        <?php $str = 'I have few questions how to use the new released product.' ?>
        <?php for ($i=0; $i <5 ; $i++) :
            $notificationStatus = (rand(0,1) == 1) ? 'read' : 'unread';   ?>
            <a href="?section=message-details&ticketId=<?php print rand(1, 200); ?>" class="list-group-item <?php print $notificationStatus; ?> ">
            <h4 style="padding:0px;margin:0px;padding-bottom: 5px; " class="list-group-item-heading">
                <?php  print substr($str, 0, rand(10,50)); ?>
            </h4>
            <span style='color:blue'> Jesus Erwin Suarez  </span>
            <p class="list-group-item-text">
                <?php print substr($str, 0, rand(10,50)); ?>
            </p>
            </a>
        <?php endfor; ?>
    </div>
</div>