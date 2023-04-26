<?php
class Validate{
    private $_passed = false,
            $_errors = array(),
            $_db = null;

        public function __construct(){
            $this->_db = DB::getInstance();
        }

        public function check($source, $items =array()){
            foreach ($items as $item => $rules) {
                foreach ($rules as $rule => $rule_value) {
                    $value = trim($source[$item]);
                    $item = escape($item);
                    if($rule=== 'required' && empty($value)){
                        $this->addError(strtoupper($item)." is required.");
                    }else if(!empty($value)){
                        switch($rule){
                            case 'min':
                                if(strlen($value) < $rule_value){
                                    $this->addError(strtoupper($item)." must be minimum of {$rule_value} character");
                                }
                            break;
                            case 'max':
                                if(strlen($value) > $rule_value){
                                    $this->addError(strtoupper($item)." must be minimum of {$rule_value} character");
                                }
                            break;
                            case 'matches':
                                if($value != $source[$rule_value]){
                                    $this->addError(strtoupper($rule_value)." must match ".strtoupper($item));
                                }
                            break;
                            case 'unique':
                                $check = $this->_db->get($rule_value, array($item,'=',$value));
                                if($check->count()){
                                    $this->addError(strtoupper($item)." already exists");
                                }
                            break;
                            case 'type':
                                if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                                    $this->addError(strtoupper($item). " must be in a valid format! ");
                                } else if (!preg_match(
                                    "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $value)) {
                                    $this->addError(strtoupper($item). " must first contain letter ");
                                }
                            break;
                            case 'type1': 
                                if(!ctype_alnum(str_replace(' ', '', $value))) {
                                    $this->addError(strtoupper($item). " is Not Applicable! ");
                                }else if (preg_match(
                                    "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $value)) {
                                    $this->addError(strtoupper($item). " must first contain letter ");
                                }
                            break;
                            case 'type2':
                                if(!ctype_alpha(str_replace(' ', '', $value))) {
                                    $this->addError(strtoupper($item). " is Not Applicable! ");
                                }
                            break;
                            case 'type3': 
                                if(!ctype_alnum(str_replace(' ', '', $value))) {
                                    $this->addError(strtoupper($item). " is Not Applicable! ");
                                }
                            break;
                            case 'matches2':
                                $checked = false;
                                foreach($_POST["cbx"] as $key) {
                                    if(!empty($key)) {
                                        $checked = true;
                                    }
                                }

                                    if(!$checked) {
                                        echo "<script src='text/javascript'>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Checkbox is Required',
                                            showConfirmButton: false,
                                            timerProgressBar: true,
                                            timer: 2000
                                            });
                                        </script>";
    }
                            break;
                        }

                    }
                }
            }
            if(empty($this->_errors)){
                $this->_passed =true;
            }
            return $this;
        }
        private function addError($errors){
            $this->_errors[] = $errors;

        }
        public function errors(){
            return $this->_errors;
        }

        public function passed(){
            return $this->_passed;
        }
        


}
