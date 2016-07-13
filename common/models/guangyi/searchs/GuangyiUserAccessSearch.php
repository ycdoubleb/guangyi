<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\guangyi\searchs;

use common\models\guangyi\GuangyiAssessLog;
use yii\base\Model;
use yii\data\ArrayDataProvider;

/**
 * Description of GuangyiUserAccessSearch
 *
 * @author Administrator
 */
class GuangyiUserAccessSearch extends Model{
    
    public function search($uid){
        $query = GuangyiAssessLog::find()
                ->andFilterWhere(['u_id'=>$uid])
                ->orderBy('created_at DESC');
        
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query->asArray()->all(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        return $dataProvider;
    }
}
