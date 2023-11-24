<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Insights\V1\Call;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 *
 * @property string $callSid
 * @property string $accountSid
 * @property string $answeredBy
 * @property string $connectivityIssue
 * @property string[] $qualityIssues
 * @property bool $spam
 * @property int $callScore
 * @property string $comment
 * @property string $incident
 * @property string $url
 */
class AnnotationInstance extends InstanceResource {
    /**
     * Initialize the AnnotationInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $callSid Call SID.
     */
    public function __construct(Version $version, array $payload, string $callSid) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'callSid' => Values::array_get($payload, 'call_sid'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'answeredBy' => Values::array_get($payload, 'answered_by'),
            'connectivityIssue' => Values::array_get($payload, 'connectivity_issue'),
            'qualityIssues' => Values::array_get($payload, 'quality_issues'),
            'spam' => Values::array_get($payload, 'spam'),
            'callScore' => Values::array_get($payload, 'call_score'),
            'comment' => Values::array_get($payload, 'comment'),
            'incident' => Values::array_get($payload, 'incident'),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['callSid' => $callSid, ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return AnnotationContext Context for this AnnotationInstance
     */
    protected function proxy(): AnnotationContext {
        if (!$this->context) {
            $this->context = new AnnotationContext($this->version, $this->solution['callSid']);
        }

        return $this->context;
    }

    /**
     * Update the AnnotationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return AnnotationInstance Updated AnnotationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): AnnotationInstance {
        return $this->proxy()->update($options);
    }

    /**
     * Fetch the AnnotationInstance
     *
     * @return AnnotationInstance Fetched AnnotationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): AnnotationInstance {
        return $this->proxy()->fetch();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name) {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Insights.V1.AnnotationInstance ' . \implode(' ', $context) . ']';
    }
}