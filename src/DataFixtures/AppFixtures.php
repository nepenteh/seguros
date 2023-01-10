<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Asegurado;
use App\Entity\Aseguradora;
use App\Entity\Inmueble;
use App\Entity\Poliza;
use App\Entity\Averia;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nombres_agdo = array("Antonio","María","Julia","Pedro");
        $apellidos1 = array("López","Rodríguez","Ramírez","Martín");
        $apellidos2 = array("Fernández","Rubio","Aguilar","Cárdenas");
        $asegurados = array();

        for($i=0;$i<count($nombres_agdo);$i++) {
            $asegurado = new Asegurado();
            $asegurado->setNombre($nombres_agdo[$i]);
            $asegurado->setApellido1($apellidos1[$i]);
            $asegurado->setApellido2($apellidos2[$i]);
            $asegurados[$i]=$asegurado;
            $manager->persist($asegurado);
        }

        $nombres_agdora = array("Generali","Mapfre","Alianz");
        $cifs = array("G-11.111.111","M-22.222.222","A-33.333.333");
        $tfnos = array("611555555","622666666","633777777");
        $mails = array("info@generalix.co","info@mapfrex.co","info@alianzx.co");
        $aseguradoras = array();

        for($i=0;$i<count($nombres_agdora);$i++) {
            $aseguradora = new Aseguradora();
            $aseguradora->setNombre($nombres_agdora[$i]);
            $aseguradora->setCif($cifs[$i]);
            $aseguradora->setTelefono($tfnos[$i]);
            $aseguradora->setMail($mails[$i]);
            $aseguradoras[$i] = $aseguradora;
            $manager->persist($aseguradora);
        }

        $calles = array("C/ Árbol, 3","Avda. América, 8","C/ Verano, 10","Avda. Galileo, 6");
        $cps = array("33444","11555","22777","12345");
        $localidades = array("Jerez de la Frontera","Cádiz","Dos Hermanas","Ronda");
        $provincias = array("Cádiz","Cádiz","Sevilla","Málaga");
        $inmuebles = array();

        for($i=0;$i<count($calles);$i++) {
            $inmueble = new Inmueble();
            $inmueble->setCalle($calles[$i]);
            $inmueble->setCp($cps[$i]);
            $inmueble->setLocalidad($localidades[$i]);
            $inmueble->setProvincia($provincias[$i]);
            $inmuebles[$i] = $inmueble;
            $manager->persist($inmueble);
        }

        $refs = array("P001G","P002M","P003G","P004A");
        $tipos = array("Incendio","Todo Riesgo","Hogar Feliz","Premium");
        $aseguradora_poliza = array(0,1,2,0);
        $asegurado_poliza = array(0,2,1,3);
        $inmueble_poliza = array(0,1,2,3);
        $polizas = array();

        for($i=0;$i<count($refs);$i++) {
            $poliza = new Poliza();
            $poliza->setReferencia($refs[$i]);
            $poliza->setTipo($tipos[$i]);
            $poliza->setAseguradora($aseguradoras[$aseguradora_poliza[$i]]);
            $poliza->setAsegurado($asegurados[$asegurado_poliza[$i]]);
            $poliza->setInmueble($inmuebles[$inmueble_poliza[$i]]);
            $polizas[$i] = $poliza;
            $manager->persist($poliza);
        }

        $fechas = array(new \DateTimeImmutable("2021-10-21"),new \DateTimeImmutable("2022-08-17"),
                        new \DateTimeImmutable("2022-12-17"),new \DateTimeImmutable("2022-10-30"),
                        new \DateTimeImmutable("2022-08-09"));
        $descripciones = array("Rotura en tubería baño","Daños por subida de tensión",
                               "Humedad causada por vecino","Rotura de cristales por temporal",
                               "Rotura en puerta por intento de robo");
        $poliza_averia = array(1,2,1,3,2);

        for($i=0;$i<count($fechas);$i++) {
            $averia = new Averia();
            $averia->setFecha($fechas[$i]);
            $averia->setDescripcion($descripciones[$i]);
            $polizas[$poliza_averia[$i]]->addListaAveria($averia); //asocia automáticamente la póliza a la avería
            $manager->persist($averia);
        }        

        $manager->flush();
    }
}
