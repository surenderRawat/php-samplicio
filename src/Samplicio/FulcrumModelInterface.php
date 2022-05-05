<?php
/**
 * Created by IntelliJ IDEA.
 * User: admin
 * Date: 07-03-2019
 * Time: 17:35
 */

namespace Samplicio\Samplicio;


interface FulcrumModelInterface
{
    public static function create(array $data);
    public function update($id = null, array $data = []);
    public static function all();
    public function get();
    public function delete($id = null);
    public static function find($id = null);

}
