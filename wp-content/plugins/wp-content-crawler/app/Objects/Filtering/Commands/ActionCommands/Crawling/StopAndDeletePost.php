<?php
/**
 * Created by PhpStorm.
 * User: tsaricam
 * Date: 19/11/2020
 * Time: 19:58
 *
 * @since 1.11.0
 */

namespace WPCCrawler\Objects\Filtering\Commands\ActionCommands\Crawling;


use WPCCrawler\Exceptions\CancelSavingException;
use WPCCrawler\Objects\Enums\ValueType;
use WPCCrawler\Objects\Filtering\Commands\ActionCommands\Base\AbstractActionCommand;
use WPCCrawler\Objects\Filtering\Commands\Views\ViewDefinition;
use WPCCrawler\Objects\Filtering\Commands\Views\ViewDefinitionList;
use WPCCrawler\Objects\Filtering\Enums\CommandKey;
use WPCCrawler\Objects\Filtering\Enums\InputName;
use WPCCrawler\Objects\Views\CheckboxWithLabel;
use WPCCrawler\Objects\Views\Enums\ViewVariableName;
use WPCCrawler\Objects\Views\TextAreaWithLabel;

/**
 * This command throws a {@link CancelSavingException}. {@link PostSaver} will catch the exception, stop the rest of the
 * crawling process, and delete the post. Other places that might run this command should handle the exception
 * themselves.
 *
 * @since 1.11.0
 */
class StopAndDeletePost extends AbstractActionCommand {

    // TODO: Although this has unit tests, integration tests must be written as well.

    public function getKey(): string {
        return CommandKey::STOP_AND_DELETE_POST;
    }

    public function getName(): string {
        return _wpcc('Stop and delete the post');
    }

    public function getDescription(): ?string {
        return _wpcc('Stops the execution of the crawling operation immediately. Then, deletes the post created in 
            your site for the current URL, if the post exists.');
    }

    public function getInputDataTypes(): array {
        return [ValueType::T_CRAWLING];
    }

    protected function isOutputTypeSameAsInputType(): bool {
        return true;
    }

    public function doesNeedSubjectValue(): bool {
        return false;
    }

    protected function isTestable(): bool {
        return false;
    }

    protected function createViews(): ?ViewDefinitionList {
        return (new ViewDefinitionList())
            ->add((new ViewDefinition(TextAreaWithLabel::class))
                ->setVariable(ViewVariableName::TITLE, _wpcc('Reason'))
                ->setVariable(ViewVariableName::INFO, _wpcc('A short explanation about why the crawling should be 
                    stopped and the post should be deleted. This will be added to the log message and to the information 
                    messages that you will see when this command is run. This is optional. If you define this, you will 
                    be able to understand why this command is run when it is run.'))
                ->setVariable(ViewVariableName::NAME, InputName::REASON)
                ->setVariable(ViewVariableName::ROWS,  2)
            )
            ->add((new ViewDefinition(CheckboxWithLabel::class))
                ->setVariable(ViewVariableName::TITLE, _wpcc('Delete URL?'))
                ->setVariable(ViewVariableName::INFO,  _wpcc('Check this if the URL of the post should be deleted 
                    from the database. When the URL is deleted, the plugin will be able to save the URL to the database
                    again, if the URL is found in a category page. This means that the post can be saved again. If the
                    URL is not deleted, the post will not be saved again.'))
                ->setVariable(ViewVariableName::NAME,  InputName::DELETE_URL)
            );
    }

    /**
     * @param int|string|null $key
     * @param mixed|null      $subjectValue
     * @return mixed|void
     * @throws CancelSavingException
     * @since 1.11.0
     */
    protected function onExecute($key, $subjectValue) {
        $message = sprintf(_wpcc('"%1$s" command requested the saving operation to be stopped and the post 
            currently being crawled to be deleted.'), $this->getName());

        // If there is a reason, append it to the message.
        $reasonPart = $this->getReasonPart();
        if ($reasonPart !== null) $message .= ' ' . $reasonPart;

        throw (new CancelSavingException($message))
            ->setDeleteUrl($this->shouldDeleteUrl());
    }

    /*
     * HELPERS
     */

    /**
     * @return string|null The reason part of the message that will be logged and/or shown to the user. If there is no
     *                     reason text, returns null.
     * @since 1.11.0
     */
    protected function getReasonPart(): ?string {
        $reason = $this->getOption(InputName::REASON);
        if ($reason === null) return null;

        // Trim the reason text so that it looks nice.
        $reasonPrepared = trim($reason);
        if ($reasonPrepared === '') return null;

        $reasonPart = _wpcc('Reason') . ': "' . $reasonPrepared . '"';

        // If there is a logger, add the reason as a message so that the user can see it when debugging.
        $logger = $this->getLogger();
        if ($logger) $logger->addMessage($reasonPart);

        return $reasonPart;
    }

    /**
     * @return bool True if the "delete URL" option is checked. Otherwise, false.
     * @since 1.11.0
     */
    protected function shouldDeleteUrl(): bool {
        return $this->getCheckboxOption(InputName::DELETE_URL);
    }
}