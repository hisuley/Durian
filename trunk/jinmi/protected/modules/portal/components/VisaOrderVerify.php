<?php
/**
 * Class VisaOrderVerify
 * @author Suley<luzhang@jmlvyou.com>
 * @params none;
 * @version 1.0
 * @copyright MIT License
 */
class VisaOrderVerify extends CWidget{
	public function run(){
		switch($progress){
			case 'operate_verify':
				$this->render('operate_verify');
				break;
            case 'finance_verify':
                $this->render('finance_verify');
                break;
            case 'send_visa':
                $this->render('send_visa');
                break;
            case 'visa_result':
                $this->render('visa_result');
                break;
            case 'visa_return':
                $this->render('visa_return');
                break;
            case 'apply_again':
                $this->render('apply_again');
                break;
            default:
                break;
		}
	}
}