<?php

defined('_JEXEC') or die;
/*
class EasysubsTablePlan extends FOFTable
{
  public function __construct($table, $key, &$db)
  {
      $query = $db->getQuery(true)
      				->select($db->qn('#__easysubs_planperiods').'.easysubs_planperiod_id')
                  ->select($db->qn('#__easysubs_planperiods').'.period')
                  ->select($db->qn('#__easysubs_planperiods').'.period_unit')
                  ->select($db->qn('#__easysubs_planperiods').'.price')
                  ->select($db->qn('#__easysubs_planperiods').'.plan_id')   
                  ->select($db->qn('#__easysubs_planperiods').'.zone_id')
                  ->leftJoin('#__easysubs_planperiods ON #__easysubs_planperiods.easysubs_plan_id = #__easysubs_plans.easysubs_plan_id');

      $this->setQueryJoin($query);
      parent::__construct($table, $key, $db);
  }
}
*/
