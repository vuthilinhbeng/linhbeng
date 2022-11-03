<?php
/**
 * Created by PhpStorm.
 * User: tsaricam
 * Date: 07/07/2020
 * Time: 20:58
 *
 * @since 1.11.0
 */

namespace WPCCrawler\Objects\Filtering\Property\Base;


use Illuminate\Support\Str;

/**
 * Properties that should be displayed for action commands should extend this class. When a property extends this class,
 * it means the property is suitable for both condition and action commands.
 *
 * @since 1.11.0
 */
abstract class AbstractActionProperty extends AbstractProperty {

    /** @var string Used as a separator when creating a unique key for a calculated subject value. */
    const KEY_SEPARATOR = '<>p>';

    /**
     * Revert the structure of an array that was previously restructured by this property. See {@link revertStructure()}
     * for more information.
     *
     * @param array $newSubjectValues See {@link revertStructure()}
     * @return array|null See {@link revertStructure()}
     * @since 1.11.0
     * @noinspection PhpUnusedParameterInspection
     */
    protected function onRevertStructure(array $newSubjectValues): ?array {
        // Return null, meaning that the restructuring operation was not successful such that the new values should not
        // be reassigned to the data source. This method must be implemented by the child class that changed the
        // structure in the first place.
        return null;
    }

    /*
     *
     */

    /**
     * Undo the restructuring operation made on the subject values earlier by this property when calculating the new
     * values of the subjects. For example, if this property produced multiple outputs from a single subject value,
     * then it is not assignable to the data source. The property needs to revert the structure into its original such
     * that the resultant array's keys and values can be directly used to reassign a value to the data source.
     *
     * @param array|null $newSubjectValues Key-value pairs where the keys are the ones created by the property, while
     *                                     the values are modified values.
     * @return array|null
     * @since 1.11.0
     */
    public function revertStructure(?array $newSubjectValues): ?array {
        // If the given array is null, return null.
        if ($newSubjectValues === null) return null;

        // If the array is empty, return it back. We do not need to perform any operation on it.
        if (!$newSubjectValues) return $newSubjectValues;

        // If the subject values were not restructured, return them without modifying anything. The modified keys
        // contain a specific separator. When the keys are modified, they are modified all. So, checking if the first
        // key has the separator or not is sufficient to understand if the subject keys were modified previously.
        if (!Str::contains(array_keys($newSubjectValues)[0], static::KEY_SEPARATOR)) return $newSubjectValues;

        // Revert the structure
        return $this->onRevertStructure($newSubjectValues);
    }

    public function toArray(): array {
        return array_merge(parent::toArray(), [
            'actionProperty' => true,
        ]);
    }

}