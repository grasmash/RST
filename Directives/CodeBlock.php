<?php

namespace Gregwar\RST\Directives;

use Gregwar\RST\Parser;
use Gregwar\RST\Directive;

use Gregwar\RST\Nodes\WrapperNode;
use Gregwar\RST\Nodes\CodeNode;

/**
 * Renders a code block, example:
 *
 * .. code-block:: php
 *
 *      <?php
 *
 *      echo "Hello world!\n";
 */
class CodeBlock extends Directive
{
    public function getName()
    {
        return 'code-block';
    }

    public function process(Parser $parser, $node, $variable, $data, array $options)
    {
        if ($node) {
            $kernel = $parser->getKernel();

            if ($node instanceof CodeNode) {
                $node->setLanguage(trim($data));
            }

            $document = $parser->getDocument();
            $document->addNode($kernel->build('Nodes\CodeBlockNode', $node));
        }
    }

    public function wantCode()
    {
        return true;
    }
}