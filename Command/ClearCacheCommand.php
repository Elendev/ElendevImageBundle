<?php
/**
 * Copyright 2012 Jonas Renaudot <www.elendev.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Elendev\ImageBundle\Command;


use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputInterface;

use Symfony\Component\Filesystem\Filesystem;

use Symfony\Component\Finder\Finder;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class ClearCacheCommand extends ContainerAwareCommand {
	
	protected function configure(){
		$this
			->setName("elendev:image:clear")
			->setDescription("Clear generated images");
	}
	
	protected function execute(InputInterface $input, OutputInterface $output) {
		$cacheDirectory = $this->getContainer()->getParameter("elendev.image.cacheDirectory");
		
		$output->writeln("Remove cached medias in " . $cacheDirectory . "...");
		
		$finder = new Finder();
		$fs = new Filesystem();
		
		$finder->in($cacheDirectory);
		$fs->remove($finder);
		
		$output->writeln("Cached medias removed");
	}
}
