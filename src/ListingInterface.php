<?php

namespace Jcbl\Booliwrapper;

interface ListingInterface
{
    public function listing($city);
    public function single($id);
    public function latest();
}