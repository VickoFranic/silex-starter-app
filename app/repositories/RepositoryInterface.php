<?php

namespace app\repositories;

/**
 *
 * RepositoryInterface is base interface that all application repositories implement.
 * It defines base methods signature - methods that every repository has to implement.
 *
 * More info about interfaces: http://php.net/manual/en/language.oop5.interfaces.php
 */
interface RepositoryInterface {

	/**
	 * Saves model to database
	 * @param object $model
	 */
	public function save($model);

	/**
	 * Returns data from DB for given id
	 * @param integer $id
	 */
	public function find($id);

	/**
	 * Returns all data from DB table
	 */
	public function findAll();
	
}