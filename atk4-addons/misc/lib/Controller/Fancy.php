<?php
/*
   Selection of utilities for making thinsg fancy 


   Due to date functions, this controller requries PHP5.3+
   */

class Controller_Fancy extends AbstractController {
    function fancy_datetime($dt,$now='now'){

        $now=new DateTime($now);
        $dt=new DateTime($dt);

        $interval=$dt->diff($now);

        if($interval->format('%a')){
            return $dt->format($this->api->getConfig('locale/date','d/m/Y'));
        }

        // Zero days, show fancy format
        $h=$interval->format('%h');
        if($h>1)return $h.' hours ago';
        if($h)return 'a hour ago';

        
        $m=$interval->format('%i');
        if($m>1)return $m.' minutes ago';

        return 'just now';
    }
}
