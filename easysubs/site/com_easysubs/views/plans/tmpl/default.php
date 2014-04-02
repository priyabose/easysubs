<?php
   /*------------------------------------------------------------------------
    # com_flycart
   # ------------------------------------------------------------------------
   # author   Gokila priya   - Weblogicx India http://www.weblogicxindia.com
   # copyright Copyright (C) 2014 Weblogicxindia.com. All Rights Reserved.
   # @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
   # Websites: http://themeparrot.com
   # Technical Support:  Forum - http://flycart.org/forum/index.html
   -------------------------------------------------------------------------*/
   defined('_JEXEC') or die;
   
   require_once(JPATH_ADMINISTRATOR.'/components/com_easysubs/app/App.php');
   print_r($this->items);
   
   $this->currency=Easysubs::load('currency');
   
   	
   ?>
<div class="row-fluid">
   <div class="span12">
      <?php foreach($this->items as $item): ?>
      <div class="well span5">
         <h2><?php echo $item->plan_title;?></h2>
         <?php echo $item->period;?> <?php echo $item->period_unit;?>
         <br/>
         <strong><?php echo $this->currency->format($item->price); ?></strong>
         <form class="easysubs-cartForm" action="index.php"  id="SubForm-<?php echo $item->easysubs_plan_id;?>" name="cartForm" method="post" >
            <input type="hidden" name="plan_price" value="<?php echo $item->price?>" />
            <input type="hidden" name="plan_id" value="<?php echo $item->easysubs_plan_id;?>"/>
            <input type="hidden" name="option" value="com_easysubs"/>
            <input type="hidden" name="view" value="plans"/>
            <input type="hidden" name="task" value="subscribe"/>
            <input type="submit" class="btn btn-primary" value="subscribe"/>
         </form>
      </div>
      <?php endforeach;?>
   </div>
</div>
