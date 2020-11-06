<?php

namespace Modules\Post\Interfaces;
 
interface PostInterface
{
 public function store($request);
 public function index();
 public function show($data);
 public function edit($slug);
 public function destroy($data);
 public function update($request);
}