<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Understand\Assistant\Intent;

use Twilio\InstanceContext;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class FieldContext extends InstanceContext {
    /**
     * Initialize the FieldContext
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $assistantSid The assistant_sid
     * @param string $intentSid The intent_sid
     * @param string $sid The sid
     * @return \Twilio\Rest\Preview\Understand\Assistant\Intent\FieldContext 
     */
    public function __construct(Version $version, $assistantSid, $intentSid, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('assistantSid' => $assistantSid, 'intentSid' => $intentSid, 'sid' => $sid, );

        $this->uri = '/Assistants/' . rawurlencode($assistantSid) . '/Intents/' . rawurlencode($intentSid) . '/Fields/' . rawurlencode($sid) . '';
    }

    /**
     * Fetch a FieldInstance
     * 
     * @return FieldInstance Fetched FieldInstance
     */
    public function fetch() {
        $params = Values::of(array());

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new FieldInstance(
            $this->version,
            $payload,
            $this->solution['assistantSid'],
            $this->solution['intentSid'],
            $this->solution['sid']
        );
    }

    /**
     * Deletes the FieldInstance
     * 
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete() {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Preview.Understand.FieldContext ' . implode(' ', $context) . ']';
    }
}