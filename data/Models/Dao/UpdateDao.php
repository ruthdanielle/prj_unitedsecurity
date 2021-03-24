<?php

namespace Data\Models\Dao;

class UpdateDao
{



    
    //UPDATE DE USUARIOS
    public function att($id, $tipo, $data)
    {
        //tratamento variaveis do
        $newTel = filter_var($data['telAtt'], FILTER_SANITIZE_NUMBER_INT);
        $pass = $data['passwordAtt'];
        $newPass = $data['passwordAtt1'];
        $checkPass = $data['passwordAtt2'];

        $find = (new UserDao())->findById($id);

        
        if ($find->fail()) {
            return $find->fail()->getMessage();
        }
        if (password_verify($pass, $find->senha)) {
            if ($newPass == $checkPass) {
                $find->senha = password_hash($newPass, PASSWORD_DEFAULT);
                $find->tipo = 2;
    
                if (isset($newTel)) {
                    $find->telefone =  $newTel;
                }else{
                    $find->telefone = $find->telefone;
                }    
                $find->save();
            }
        }

        return $find;
    }
    
}