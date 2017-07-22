<?php

namespace Jcbl\Booliwrapper;

interface ListingInterface
{
    public function getListing($city);
    public function getSingleListing($id);
    public function getLatest();
}