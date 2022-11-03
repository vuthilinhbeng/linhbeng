<?php
/**
 * Created by PhpStorm.
 * User: turgutsaricam
 * Date: 12/04/2020
 * Time: 09:06
 *
 * @since 1.11.0
 */

namespace WPCCrawler\Objects\Filtering\Property\Element;


use Symfony\Component\DomCrawler\Crawler;
use WPCCrawler\Objects\Enums\ValueType;
use WPCCrawler\Objects\Filtering\Commands\Base\AbstractBaseCommand;
use WPCCrawler\Objects\Filtering\Commands\Views\ViewDefinitionFactory;
use WPCCrawler\Objects\Filtering\Commands\Views\ViewDefinitionList;
use WPCCrawler\Objects\Filtering\Enums\InputName;
use WPCCrawler\Objects\Filtering\Enums\PropertyKey;
use WPCCrawler\Objects\Filtering\Property\Base\AbstractProperty;
use WPCCrawler\Objects\Filtering\Property\Objects\CalculationResult;

class ElementAttributeValueProperty extends AbstractProperty {

    public function getKey(): string {
        return PropertyKey::ELEMENT_ATTR_VALUE;
    }

    public function getName(): string {
        return _wpcc('Attribute value');
    }

    public function getInputDataTypes(): array {
        return [ValueType::T_ELEMENT];
    }

    public function getOutputDataTypes(): array {
        return [ValueType::T_STRING];
    }

    protected function createViews(): ?ViewDefinitionList {
        return (new ViewDefinitionList())
            ->add(ViewDefinitionFactory::getInstance()->createElementAttributeInput());
    }

    protected function onCalculate($key, $source, AbstractBaseCommand $cmd): ?CalculationResult {
        if (!is_a($source, Crawler::class)) return null;

        $attrName = $cmd->getOption(InputName::ELEMENT_ATTR);
        if ($attrName === null) return null;

        $attrName = (string) $attrName;
        if ($attrName === '') return null;

        /** @var Crawler $source */
        return new CalculationResult($key, $source->attr($attrName));
    }

}