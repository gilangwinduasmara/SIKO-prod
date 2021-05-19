<?php

function assetVersion($asset){
    return $asset."?v=".config('app.version');
}
