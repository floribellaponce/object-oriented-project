<?php
use FloribellaPonce\ObjectOrientedProject\Author;
use Ramsey\Uuid\Uuid;
require_once("../Classes/Author.php");

$bella =new Author("a5c7c2f9-e8c6-4ce1-adc0-a60a0f04bff0",
	"12345678912345678912345678912345",
	"https://gravatar.com/avatar/5e4a5517ddd34103f466520ec5599317?s=400&d=robohash&r=x",
	"fponce2@cnm.edu",
	"0a8941b76b054c6b776b26d6cdffa3763ef39100d2b1b25230ba0a9ae7ba44540451874df11da408603831e301d8d3a6a",
	"fponce2");

echo($bella->getAuthorId());
echo($bella->getAuthorActivationToken());
echo($bella->getAuthorAvatarUrl());
echo($bella->getAuthorEmail());
echo($bella->getAuthorHash());
echo($bella->getAuthorUsername());