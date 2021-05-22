<?php

function assetVersion($asset){
    if($asset[0] == '/'){
        return $asset."?v=".config('app.version');
    }
    return "/".$asset."?v=".config('app.version');
}
