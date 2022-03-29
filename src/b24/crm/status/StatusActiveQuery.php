<?php


namespace wm\yii\b24\crm\status;


class StatusActiveQuery extends \wm\yii\b24\ActiveQuery
{
    //    public $entityTypeId;

    protected $listMethodName = 'crm.status.list';

    protected $oneMethodName = 'crm.status.get';

    public function getEntityTypeIdUsedInFrom()
    {
//        if (empty($this->entityTypeId)) {
//            $this->entityTypeId = $this->modelClass::entityTypeId();
//        }

        return '';
    }

//    protected function getPrimaryTableName()
//    {
//        $modelClass = $this->modelClass;
//        //return $modelClass::tableName();
//        return $modelClass::entityTypeId();
//    }

    protected function prepairParams(){
//        $this->getEntityTypeIdUsedInFrom();
        $data = [
//            'entityTypeId' => $this->entityTypeId,
            'filter' => $this->where,
            'order' => $this->orderBy?$this->orderBy:null,
            'select' => $this->select,
            //Остальные параметры
        ];
        $this->params = $data;
    }

    protected function prepareFullParams($id){
        $this->params = [
            'id' => $id
        ];
    }

    protected function prepairOneParams(){
        $this->getEntityTypeIdUsedInFrom();
        $id = null;
        if(ArrayHelper::getValue($this->where, 'id')){
            $id = ArrayHelper::getValue($this->where, 'id');
        }
        if(ArrayHelper::getValue($this->link, 'id')){
            $id = ArrayHelper::getValue($this->where, 'inArray.0');
        }
        $data = [
            'id' => $id
        ];
        if($id === null && $this->where){
            $this->queryMethod = 'all';
        }else{
            $this->errorParams = true;
        }
        $this->params = $data;
    }
}