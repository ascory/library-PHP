<?php
class ascory{
    public function __construct($shop, $key1, $key2){
        $this->shop = $shop;
        $this->key1 = $key1;
        $this->key2 = $key2;
        $this->item = new ascoryItem($this);
        $this->hash = password_hash($key1.":".$key2.":".file_get_contents("https://eth0.me"));
        if(!is_int($this->shop)){
            $this->returnAnswer(false, "You have entered an incorrect shop ID.");
        }
        if(!isset($this->key1) or !$this->key1){
            $this->returnAnswer(false, "You have entered an incorrect key-1.");
        }
        if(!isset($this->key2) or !$this->key2){
            $this->returnAnswer(false, "You have entered an incorrect key-2.");
        }
    }
    private function returnAnswer($param){
        return [
            "success" => $param[0],
            "data" => $param[1]
        ];
    }
    public function createItem($param){
        if(!mb_strlen($param["name"]) < 5 or mb_strlen($param["name"]) > 30){
            $this->returnAnswer(false, "The item name should be between 5 and 30 characters.");
        }
        if(!mb_strlen($param["description"]) < 5 or mb_strlen($param["description"]) > 50){
            $this->returnAnswer(false, "The item description should be between 5 and 50 characters.");
        }
        if(!isset($param["amount"]) or !filter_var($param["amount"], FILTER_VALIDATE_FLOAT)){
            $this->returnAnswer(false, "The amount of an item must be a number between 0.1 and 1000.");
        }
        $param["amount"] = round($param["amount"], 2);
        if($param["amount"] < 0.1 or $param["amount"] > 1000){
            $this->returnAnswer(false, "The amount of an item must be a number between 0.1 and 1000.");
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.ascory.com/v1/item/create");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "accept: application/json"
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "shop" => $this->shop,
            "hash" => $this->hash,
            "name" => $param["name"],
            "description" => $param["description"],
            "amount" => $param["amount"]
        ]));
        $response = json_decode(curl_exec($ch), true);
        if($response["code"] == 200){
            $this->returnAnswer(true, $response["data"]);
        }
        if($response["code"] == 400){
            $this->returnAnswer(false, $response["data"]["en"]);
        }
        $this->returnAnswer(false, "There's been an unknown error. It may be a problem with communication with the API server or curl.");
    }
}
class ascoryItem{
    public function __construct($ascory) {
        $this->ascory = $ascory;
    }
    public function check($param){
        if(!isset($param["id"]) or !$id or !filter_var($param["id"], FILTER_VALIDATE_INT) or $param["id"] < 0){
            $this->ascory->returnAnswer(false, "The item name should be between 5 and 30 characters.");
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.ascory.com/v1/item/check");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "accept: application/json"
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "shop" => $this->ascory->shop,
            "hash" => $this->ascory->hash,
            "id" => $param["id"]
        ]));
        $response = json_decode(curl_exec($ch), true);
        if($response["code"] == 200){
            $this->ascory->returnAnswer(true, $response["data"]);
        }
        if($response["code"] == 400){
            $this->ascory->returnAnswer(false, $response["data"]["en"]);
        }
        $this->ascory->returnAnswer(false, "There's been an unknown error. It may be a problem with communication with the API server or curl.");
    }
    public function delete($param){
        if(!isset($param["id"]) or !$id or !filter_var($param["id"], FILTER_VALIDATE_INT) or $param["id"] < 0){
            $this->ascory->returnAnswer(false, "The item name should be between 5 and 30 characters.");
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.ascory.com/v1/item/delete");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "accept: application/json"
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "shop" => $this->ascory->shop,
            "hash" => $this->ascory->hash,
            "id" => $param["id"]
        ]));
        $response = json_decode(curl_exec($ch), true);
        if($response["code"] == 200){
            $this->ascory->returnAnswer(true, $response["data"]);
        }
        if($response["code"] == 400){
            $this->ascory->returnAnswer(false, $response["data"]["en"]);
        }
        $this->ascory->returnAnswer(false, "There's been an unknown error. It may be a problem with communication with the API server or curl.");
    }
}
?>