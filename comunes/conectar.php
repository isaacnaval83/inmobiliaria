<?php

function conectar(){
	return pg_connect("host=localhost user=inmobiliaria password=inmobiliaria dbname=inmobiliaria");
}