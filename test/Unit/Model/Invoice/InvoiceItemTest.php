<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoice;

use Gubee\SDK\Enum\Catalog\Product\OriginEnum;
use Gubee\SDK\Model\Invoice\InvoiceItem;
use PHPUnit\Framework\TestCase;

class InvoiceItemTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $item = new InvoiceItem(
            code: 'code_v1',
            skuId: 'skuId_v1',
            description: 'description_v1',
            ncm: 'ncm_v1',
            cst: 101,
            cfop: 'cfop_v1',
            unit: 'unit_v1',
            quantity: 1.1,
            icmsSubstituteBaseCalculation: 1.1,
            icmsSubstituteValue: 1.1,
            fcpSubstituteValue: 1.1,
            unitPrice: 1.1,
            totalPrice: 1.1,
            icmsBaseCalculation: 1.1,
            icmsValue: 1.1,
            ipiValue: 1.1,
            icmsPercentage: 1.1,
            ipiPercentage: 1.1,
            origin: 'NACIONAL_EXCETO_3_5',
            icmsModalityBaseCalc: 101,
            icmsModalityBaseCalcST: 101,
            pisCst: 101,
            cofinsCst: 101,
            fcpBaseCalculation: 1.1,
            fcpPercentage: 1.1,
            fcpValue: 1.1,
            icmsBaseCalculationDestinationState: 1.1,
            icmsInternalRateDestinationState: 1.1,
            icmsInterstateRate: 1.1,
            icmsSharingPercentage: 1.1,
            icmsValueDestinationState: 1.1,
            icmsValueSenderState: 1.1,
            fcpBaseCalculationDestinationState: 1.1,
            fcpPercentageDestinationState: 1.1,
            fcpValueDestinationState: 1.1,
            icmsReductionBC: 1.1,
            icmsSubstituteRate: 1.1,
            icmsSubstituteReductionBC: 1.1,
            icmsAddedValueMarginSt: 1.1,
            icmsSimpleCreditRate: 1.1,
            icmsSimpleCreditValue: 1.1,
            icmsOperationValue: 1.1,
            icmsDeferredPercentage: 1.1,
            icmsDeferredValue: 1.1,
            icmsStWithheldBC: 1.1,
            icmsStWithheldAmount: 1.1,
            icmsFinalRate: 1.1,
            icmsExemptValue: 1.1,
            icmsExemptReason: 101,
            icmsBaseCalculationMono: 101,
            icmsValueMono: 1.1,
            icmsWithholdingBaseCalculationMono: 101,
            icmsWithholdingRate: 1.1,
            icmsWithholdingValueMono: 1.1,
            icmsPercentualReduction: 1.1,
            icmsReductionReason: 101,
            icmsOperationValueMono: 1.1,
            icmsDeferredValueMono: 1.1,
            icmsWithheldBaseCalculation: 101,
            icmsWithheldRate: 1.1,
            icmsWithheldValueMono: 1.1,
            pisBaseCalc: 1.1,
            pisRate: 1.1,
            pisQuantity: 1.1,
            pisRateValue: 1.1,
            pisValue: 1.1,
            cofinsBaseCalc: 1.1,
            cofinsRate: 1.1,
            cofinsQuantity: 1.1,
            cofinsRateValue: 1.1,
            cofinsValue: 1.1,
            ipiCst: 101,
            ipiBaseCalc: 1.1,
            ipiQuantity: 1.1,
            ipiValuePerTaxableUnit: 1.1,
            ipiProducerCnpj: 'ipiProducerCnpj_v1',
            ipiControlSealCode: 'ipiControlSealCode_v1',
            ipiControlSealQuantity: 101,
            ipiClassificationClass: 101,
            cest: 'cest_v1',
            discount: 1.1,
            freight: 1.1,
            isTaxSituation: 'isTaxSituation_v1',
            isClassificationClass: 'isClassificationClass_v1',
            isBaseCalc: 1.1,
            isRate: 1.1,
            isSpecificRate: 1.1,
            isTaxableUnit: 'isTaxableUnit_v1',
            isTaxableQuantity: 1.1,
            isValue: 1.1,
            ibsCbsTaxSituationCode: 'ibsCbsTaxSituationCode_v1',
            ibsCbsTaxClassificationCode: 'ibsCbsTaxClassificationCode_v1',
            ibsCbsTaxBaseValue: 1.1,
            ibsUfRate: 1.1,
            ibsUfDeferralPercentage: 1.1,
            ibsUfDeferredValue: 1.1,
            ibsUfReturnedTaxValue: 1.1,
            ibsUfRateReductionPercentage: 1.1,
            ibsUfEffectiveRate: 1.1,
            ibsUfTaxValue: 1.1,
            ibsMunicipalityRate: 1.1,
            ibsMunicipalityDeferralPercentage: 1.1,
            ibsMunicipalityDeferredValue: 1.1,
            ibsMunicipalityReturnedTaxValue: 1.1,
            ibsMunicipalityRateReductionPercentage: 1.1,
            ibsMunicipalityEffectiveRate: 1.1,
            ibsMunicipalityTaxValue: 1.1,
            ibsTotalValue: 1.1,
            cbsRate: 1.1,
            cbsDeferralPercentage: 1.1,
            cbsDeferredValue: 1.1,
            cbsReturnedTaxValue: 1.1,
            cbsRateReductionPercentage: 1.1,
            cbsEffectiveRate: 1.1,
            cbsValue: 1.1,
            ibsCbsRegularTaxSituationCode: 'ibsCbsRegularTaxSituationCode_v1',
            ibsCbsRegularTaxClassificationCode: 'ibsCbsRegularTaxClassificationCode_v1',
            ibsUfRegularEffectiveRate: 1.1,
            ibsUfRegularTaxValue: 1.1,
            ibsMunicipalityRegularEffectiveRate: 1.1,
            ibsMunicipalityRegularTaxValue: 1.1,
            cbsRegularEffectiveRate: 1.1,
            cbsRegularTaxValue: 1.1,
            presumedCreditClassificationCode: 101,
            ibsPresumedCreditPercentage: 1.1,
            ibsPresumedCreditValue: 1.1,
            ibsPresumedCreditSuspensiveConditionValue: 1.1,
            cbsPresumedCreditPercentage: 1.1,
            cbsPresumedCreditValue: 1.1,
            cbsPresumedCreditSuspensiveConditionValue: 1.1,
            presumedCreditZfmCompetence: 'presumedCreditZfmCompetence_v1',
            presumedCreditZfmClassification: 'presumedCreditZfmClassification_v1',
            presumedCreditZfmValue: 1.1,
            monoTaxedQuantityBase: 1.1,
            monoIbsAdRemRate: 1.1,
            monoCbsAdRemRate: 1.1,
            monoIbsValue: 1.1,
            monoCbsValue: 1.1,
            monoRetainedTaxedQuantityBase: 1.1,
            monoIbsRetentionRate: 1.1,
            monoIbsRetentionValue: 1.1,
            monoCbsRetentionRate: 1.1,
            monoCbsRetentionValue: 1.1,
            monoPreviouslyRetainedQuantityBase: 1.1,
            monoIbsPreviouslyRetainedRate: 1.1,
            monoIbsPreviouslyRetainedValue: 1.1,
            monoCbsPreviouslyRetainedRate: 1.1,
            monoCbsPreviouslyRetainedValue: 1.1,
            monoIbsDeferredPercentage: 1.1,
            monoIbsDeferredValue: 1.1,
            monoCbsDeferredPercentage: 1.1,
            monoCbsDeferredValue: 1.1,
            monoIbsTotalItem: 1.1,
            monoCbsTotalItem: 1.1,
            ibsTransferredValue: 1.1,
            cbsTransferredValue: 1.1,
            assessmentCompetenceDate: 'assessmentCompetenceDate_v1',
            ibsCompetenceAdjustmentAmount: 1.1,
            cbsCompetenceAdjustmentAmount: 1.1,
            fuelAnpCode: 'fuelAnpCode_v1',
            fuelAnpDescription: 'fuelAnpDescription_v1',
            fuelUf: 'fuelUf_v1',
            taxBenefitCode: 'taxBenefitCode_v1',
        );

        $this->assertSame('code_v1', $item->getCode());
        $this->assertSame('skuId_v1', $item->getSkuId());
        $this->assertSame('description_v1', $item->getDescription());
        $this->assertSame('ncm_v1', $item->getNcm());
        $this->assertSame(101, $item->getCst());
        $this->assertSame('cfop_v1', $item->getCfop());
        $this->assertSame('unit_v1', $item->getUnit());
        $this->assertSame(1.1, $item->getQuantity());
        $this->assertSame(1.1, $item->getIcmsSubstituteBaseCalculation());
        $this->assertSame(1.1, $item->getIcmsSubstituteValue());
        $this->assertSame(1.1, $item->getFcpSubstituteValue());
        $this->assertSame(1.1, $item->getUnitPrice());
        $this->assertSame(1.1, $item->getTotalPrice());
        $this->assertSame(1.1, $item->getIcmsBaseCalculation());
        $this->assertSame(1.1, $item->getIcmsValue());
        $this->assertSame(1.1, $item->getIpiValue());
        $this->assertSame(1.1, $item->getIcmsPercentage());
        $this->assertSame(1.1, $item->getIpiPercentage());
        $this->assertInstanceOf(OriginEnum::class, $item->getOrigin());
        $this->assertSame('NACIONAL_EXCETO_3_5', (string) $item->getOrigin());
        $this->assertSame(101, $item->getIcmsModalityBaseCalc());
        $this->assertSame(101, $item->getIcmsModalityBaseCalcST());
        $this->assertSame(101, $item->getPisCst());
        $this->assertSame(101, $item->getCofinsCst());
        $this->assertSame(1.1, $item->getFcpBaseCalculation());
        $this->assertSame(1.1, $item->getFcpPercentage());
        $this->assertSame(1.1, $item->getFcpValue());
        $this->assertSame(1.1, $item->getIcmsBaseCalculationDestinationState());
        $this->assertSame(1.1, $item->getIcmsInternalRateDestinationState());
        $this->assertSame(1.1, $item->getIcmsInterstateRate());
        $this->assertSame(1.1, $item->getIcmsSharingPercentage());
        $this->assertSame(1.1, $item->getIcmsValueDestinationState());
        $this->assertSame(1.1, $item->getIcmsValueSenderState());
        $this->assertSame(1.1, $item->getFcpBaseCalculationDestinationState());
        $this->assertSame(1.1, $item->getFcpPercentageDestinationState());
        $this->assertSame(1.1, $item->getFcpValueDestinationState());
        $this->assertSame(1.1, $item->getIcmsReductionBC());
        $this->assertSame(1.1, $item->getIcmsSubstituteRate());
        $this->assertSame(1.1, $item->getIcmsSubstituteReductionBC());
        $this->assertSame(1.1, $item->getIcmsAddedValueMarginSt());
        $this->assertSame(1.1, $item->getIcmsSimpleCreditRate());
        $this->assertSame(1.1, $item->getIcmsSimpleCreditValue());
        $this->assertSame(1.1, $item->getIcmsOperationValue());
        $this->assertSame(1.1, $item->getIcmsDeferredPercentage());
        $this->assertSame(1.1, $item->getIcmsDeferredValue());
        $this->assertSame(1.1, $item->getIcmsStWithheldBC());
        $this->assertSame(1.1, $item->getIcmsStWithheldAmount());
        $this->assertSame(1.1, $item->getIcmsFinalRate());
        $this->assertSame(1.1, $item->getIcmsExemptValue());
        $this->assertSame(101, $item->getIcmsExemptReason());
        $this->assertSame(101, $item->getIcmsBaseCalculationMono());
        $this->assertSame(1.1, $item->getIcmsValueMono());
        $this->assertSame(101, $item->getIcmsWithholdingBaseCalculationMono());
        $this->assertSame(1.1, $item->getIcmsWithholdingRate());
        $this->assertSame(1.1, $item->getIcmsWithholdingValueMono());
        $this->assertSame(1.1, $item->getIcmsPercentualReduction());
        $this->assertSame(101, $item->getIcmsReductionReason());
        $this->assertSame(1.1, $item->getIcmsOperationValueMono());
        $this->assertSame(1.1, $item->getIcmsDeferredValueMono());
        $this->assertSame(101, $item->getIcmsWithheldBaseCalculation());
        $this->assertSame(1.1, $item->getIcmsWithheldRate());
        $this->assertSame(1.1, $item->getIcmsWithheldValueMono());
        $this->assertSame(1.1, $item->getPisBaseCalc());
        $this->assertSame(1.1, $item->getPisRate());
        $this->assertSame(1.1, $item->getPisQuantity());
        $this->assertSame(1.1, $item->getPisRateValue());
        $this->assertSame(1.1, $item->getPisValue());
        $this->assertSame(1.1, $item->getCofinsBaseCalc());
        $this->assertSame(1.1, $item->getCofinsRate());
        $this->assertSame(1.1, $item->getCofinsQuantity());
        $this->assertSame(1.1, $item->getCofinsRateValue());
        $this->assertSame(1.1, $item->getCofinsValue());
        $this->assertSame(101, $item->getIpiCst());
        $this->assertSame(1.1, $item->getIpiBaseCalc());
        $this->assertSame(1.1, $item->getIpiQuantity());
        $this->assertSame(1.1, $item->getIpiValuePerTaxableUnit());
        $this->assertSame('ipiProducerCnpj_v1', $item->getIpiProducerCnpj());
        $this->assertSame('ipiControlSealCode_v1', $item->getIpiControlSealCode());
        $this->assertSame(101, $item->getIpiControlSealQuantity());
        $this->assertSame(101, $item->getIpiClassificationClass());
        $this->assertSame('cest_v1', $item->getCest());
        $this->assertSame(1.1, $item->getDiscount());
        $this->assertSame(1.1, $item->getFreight());
        $this->assertSame('isTaxSituation_v1', $item->getIsTaxSituation());
        $this->assertSame('isClassificationClass_v1', $item->getIsClassificationClass());
        $this->assertSame(1.1, $item->getIsBaseCalc());
        $this->assertSame(1.1, $item->getIsRate());
        $this->assertSame(1.1, $item->getIsSpecificRate());
        $this->assertSame('isTaxableUnit_v1', $item->getIsTaxableUnit());
        $this->assertSame(1.1, $item->getIsTaxableQuantity());
        $this->assertSame(1.1, $item->getIsValue());
        $this->assertSame('ibsCbsTaxSituationCode_v1', $item->getIbsCbsTaxSituationCode());
        $this->assertSame('ibsCbsTaxClassificationCode_v1', $item->getIbsCbsTaxClassificationCode());
        $this->assertSame(1.1, $item->getIbsCbsTaxBaseValue());
        $this->assertSame(1.1, $item->getIbsUfRate());
        $this->assertSame(1.1, $item->getIbsUfDeferralPercentage());
        $this->assertSame(1.1, $item->getIbsUfDeferredValue());
        $this->assertSame(1.1, $item->getIbsUfReturnedTaxValue());
        $this->assertSame(1.1, $item->getIbsUfRateReductionPercentage());
        $this->assertSame(1.1, $item->getIbsUfEffectiveRate());
        $this->assertSame(1.1, $item->getIbsUfTaxValue());
        $this->assertSame(1.1, $item->getIbsMunicipalityRate());
        $this->assertSame(1.1, $item->getIbsMunicipalityDeferralPercentage());
        $this->assertSame(1.1, $item->getIbsMunicipalityDeferredValue());
        $this->assertSame(1.1, $item->getIbsMunicipalityReturnedTaxValue());
        $this->assertSame(1.1, $item->getIbsMunicipalityRateReductionPercentage());
        $this->assertSame(1.1, $item->getIbsMunicipalityEffectiveRate());
        $this->assertSame(1.1, $item->getIbsMunicipalityTaxValue());
        $this->assertSame(1.1, $item->getIbsTotalValue());
        $this->assertSame(1.1, $item->getCbsRate());
        $this->assertSame(1.1, $item->getCbsDeferralPercentage());
        $this->assertSame(1.1, $item->getCbsDeferredValue());
        $this->assertSame(1.1, $item->getCbsReturnedTaxValue());
        $this->assertSame(1.1, $item->getCbsRateReductionPercentage());
        $this->assertSame(1.1, $item->getCbsEffectiveRate());
        $this->assertSame(1.1, $item->getCbsValue());
        $this->assertSame('ibsCbsRegularTaxSituationCode_v1', $item->getIbsCbsRegularTaxSituationCode());
        $this->assertSame('ibsCbsRegularTaxClassificationCode_v1', $item->getIbsCbsRegularTaxClassificationCode());
        $this->assertSame(1.1, $item->getIbsUfRegularEffectiveRate());
        $this->assertSame(1.1, $item->getIbsUfRegularTaxValue());
        $this->assertSame(1.1, $item->getIbsMunicipalityRegularEffectiveRate());
        $this->assertSame(1.1, $item->getIbsMunicipalityRegularTaxValue());
        $this->assertSame(1.1, $item->getCbsRegularEffectiveRate());
        $this->assertSame(1.1, $item->getCbsRegularTaxValue());
        $this->assertSame(101, $item->getPresumedCreditClassificationCode());
        $this->assertSame(1.1, $item->getIbsPresumedCreditPercentage());
        $this->assertSame(1.1, $item->getIbsPresumedCreditValue());
        $this->assertSame(1.1, $item->getIbsPresumedCreditSuspensiveConditionValue());
        $this->assertSame(1.1, $item->getCbsPresumedCreditPercentage());
        $this->assertSame(1.1, $item->getCbsPresumedCreditValue());
        $this->assertSame(1.1, $item->getCbsPresumedCreditSuspensiveConditionValue());
        $this->assertSame('presumedCreditZfmCompetence_v1', $item->getPresumedCreditZfmCompetence());
        $this->assertSame('presumedCreditZfmClassification_v1', $item->getPresumedCreditZfmClassification());
        $this->assertSame(1.1, $item->getPresumedCreditZfmValue());
        $this->assertSame(1.1, $item->getMonoTaxedQuantityBase());
        $this->assertSame(1.1, $item->getMonoIbsAdRemRate());
        $this->assertSame(1.1, $item->getMonoCbsAdRemRate());
        $this->assertSame(1.1, $item->getMonoIbsValue());
        $this->assertSame(1.1, $item->getMonoCbsValue());
        $this->assertSame(1.1, $item->getMonoRetainedTaxedQuantityBase());
        $this->assertSame(1.1, $item->getMonoIbsRetentionRate());
        $this->assertSame(1.1, $item->getMonoIbsRetentionValue());
        $this->assertSame(1.1, $item->getMonoCbsRetentionRate());
        $this->assertSame(1.1, $item->getMonoCbsRetentionValue());
        $this->assertSame(1.1, $item->getMonoPreviouslyRetainedQuantityBase());
        $this->assertSame(1.1, $item->getMonoIbsPreviouslyRetainedRate());
        $this->assertSame(1.1, $item->getMonoIbsPreviouslyRetainedValue());
        $this->assertSame(1.1, $item->getMonoCbsPreviouslyRetainedRate());
        $this->assertSame(1.1, $item->getMonoCbsPreviouslyRetainedValue());
        $this->assertSame(1.1, $item->getMonoIbsDeferredPercentage());
        $this->assertSame(1.1, $item->getMonoIbsDeferredValue());
        $this->assertSame(1.1, $item->getMonoCbsDeferredPercentage());
        $this->assertSame(1.1, $item->getMonoCbsDeferredValue());
        $this->assertSame(1.1, $item->getMonoIbsTotalItem());
        $this->assertSame(1.1, $item->getMonoCbsTotalItem());
        $this->assertSame(1.1, $item->getIbsTransferredValue());
        $this->assertSame(1.1, $item->getCbsTransferredValue());
        $this->assertSame('assessmentCompetenceDate_v1', $item->getAssessmentCompetenceDate());
        $this->assertSame(1.1, $item->getIbsCompetenceAdjustmentAmount());
        $this->assertSame(1.1, $item->getCbsCompetenceAdjustmentAmount());
        $this->assertSame('fuelAnpCode_v1', $item->getFuelAnpCode());
        $this->assertSame('fuelAnpDescription_v1', $item->getFuelAnpDescription());
        $this->assertSame('fuelUf_v1', $item->getFuelUf());
        $this->assertSame('taxBenefitCode_v1', $item->getTaxBenefitCode());
    }

    public function testSetters(): void
    {
        $item    = new InvoiceItem();
        $origin2 = OriginEnum::NACIONAL_COM_IMPORTACAO_SUPERIOR_40();

        $item->setCode('code_v2');
        $this->assertSame('code_v2', $item->getCode());
        $item->setSkuId('skuId_v2');
        $this->assertSame('skuId_v2', $item->getSkuId());
        $item->setDescription('description_v2');
        $this->assertSame('description_v2', $item->getDescription());
        $item->setNcm('ncm_v2');
        $this->assertSame('ncm_v2', $item->getNcm());
        $item->setCst(201);
        $this->assertSame(201, $item->getCst());
        $item->setCfop('cfop_v2');
        $this->assertSame('cfop_v2', $item->getCfop());
        $item->setUnit('unit_v2');
        $this->assertSame('unit_v2', $item->getUnit());
        $item->setQuantity(2.2);
        $this->assertSame(2.2, $item->getQuantity());
        $item->setIcmsSubstituteBaseCalculation(2.2);
        $this->assertSame(2.2, $item->getIcmsSubstituteBaseCalculation());
        $item->setIcmsSubstituteValue(2.2);
        $this->assertSame(2.2, $item->getIcmsSubstituteValue());
        $item->setFcpSubstituteValue(2.2);
        $this->assertSame(2.2, $item->getFcpSubstituteValue());
        $item->setUnitPrice(2.2);
        $this->assertSame(2.2, $item->getUnitPrice());
        $item->setTotalPrice(2.2);
        $this->assertSame(2.2, $item->getTotalPrice());
        $item->setIcmsBaseCalculation(2.2);
        $this->assertSame(2.2, $item->getIcmsBaseCalculation());
        $item->setIcmsValue(2.2);
        $this->assertSame(2.2, $item->getIcmsValue());
        $item->setIpiValue(2.2);
        $this->assertSame(2.2, $item->getIpiValue());
        $item->setIcmsPercentage(2.2);
        $this->assertSame(2.2, $item->getIcmsPercentage());
        $item->setIpiPercentage(2.2);
        $this->assertSame(2.2, $item->getIpiPercentage());
        $item->setOrigin($origin2);
        $this->assertSame($origin2, $item->getOrigin());
        $item->setIcmsModalityBaseCalc(201);
        $this->assertSame(201, $item->getIcmsModalityBaseCalc());
        $item->setIcmsModalityBaseCalcST(201);
        $this->assertSame(201, $item->getIcmsModalityBaseCalcST());
        $item->setPisCst(201);
        $this->assertSame(201, $item->getPisCst());
        $item->setCofinsCst(201);
        $this->assertSame(201, $item->getCofinsCst());
        $item->setFcpBaseCalculation(2.2);
        $this->assertSame(2.2, $item->getFcpBaseCalculation());
        $item->setFcpPercentage(2.2);
        $this->assertSame(2.2, $item->getFcpPercentage());
        $item->setFcpValue(2.2);
        $this->assertSame(2.2, $item->getFcpValue());
        $item->setIcmsBaseCalculationDestinationState(2.2);
        $this->assertSame(2.2, $item->getIcmsBaseCalculationDestinationState());
        $item->setIcmsInternalRateDestinationState(2.2);
        $this->assertSame(2.2, $item->getIcmsInternalRateDestinationState());
        $item->setIcmsInterstateRate(2.2);
        $this->assertSame(2.2, $item->getIcmsInterstateRate());
        $item->setIcmsSharingPercentage(2.2);
        $this->assertSame(2.2, $item->getIcmsSharingPercentage());
        $item->setIcmsValueDestinationState(2.2);
        $this->assertSame(2.2, $item->getIcmsValueDestinationState());
        $item->setIcmsValueSenderState(2.2);
        $this->assertSame(2.2, $item->getIcmsValueSenderState());
        $item->setFcpBaseCalculationDestinationState(2.2);
        $this->assertSame(2.2, $item->getFcpBaseCalculationDestinationState());
        $item->setFcpPercentageDestinationState(2.2);
        $this->assertSame(2.2, $item->getFcpPercentageDestinationState());
        $item->setFcpValueDestinationState(2.2);
        $this->assertSame(2.2, $item->getFcpValueDestinationState());
        $item->setIcmsReductionBC(2.2);
        $this->assertSame(2.2, $item->getIcmsReductionBC());
        $item->setIcmsSubstituteRate(2.2);
        $this->assertSame(2.2, $item->getIcmsSubstituteRate());
        $item->setIcmsSubstituteReductionBC(2.2);
        $this->assertSame(2.2, $item->getIcmsSubstituteReductionBC());
        $item->setIcmsAddedValueMarginSt(2.2);
        $this->assertSame(2.2, $item->getIcmsAddedValueMarginSt());
        $item->setIcmsSimpleCreditRate(2.2);
        $this->assertSame(2.2, $item->getIcmsSimpleCreditRate());
        $item->setIcmsSimpleCreditValue(2.2);
        $this->assertSame(2.2, $item->getIcmsSimpleCreditValue());
        $item->setIcmsOperationValue(2.2);
        $this->assertSame(2.2, $item->getIcmsOperationValue());
        $item->setIcmsDeferredPercentage(2.2);
        $this->assertSame(2.2, $item->getIcmsDeferredPercentage());
        $item->setIcmsDeferredValue(2.2);
        $this->assertSame(2.2, $item->getIcmsDeferredValue());
        $item->setIcmsStWithheldBC(2.2);
        $this->assertSame(2.2, $item->getIcmsStWithheldBC());
        $item->setIcmsStWithheldAmount(2.2);
        $this->assertSame(2.2, $item->getIcmsStWithheldAmount());
        $item->setIcmsFinalRate(2.2);
        $this->assertSame(2.2, $item->getIcmsFinalRate());
        $item->setIcmsExemptValue(2.2);
        $this->assertSame(2.2, $item->getIcmsExemptValue());
        $item->setIcmsExemptReason(201);
        $this->assertSame(201, $item->getIcmsExemptReason());
        $item->setIcmsBaseCalculationMono(201);
        $this->assertSame(201, $item->getIcmsBaseCalculationMono());
        $item->setIcmsValueMono(2.2);
        $this->assertSame(2.2, $item->getIcmsValueMono());
        $item->setIcmsWithholdingBaseCalculationMono(201);
        $this->assertSame(201, $item->getIcmsWithholdingBaseCalculationMono());
        $item->setIcmsWithholdingRate(2.2);
        $this->assertSame(2.2, $item->getIcmsWithholdingRate());
        $item->setIcmsWithholdingValueMono(2.2);
        $this->assertSame(2.2, $item->getIcmsWithholdingValueMono());
        $item->setIcmsPercentualReduction(2.2);
        $this->assertSame(2.2, $item->getIcmsPercentualReduction());
        $item->setIcmsReductionReason(201);
        $this->assertSame(201, $item->getIcmsReductionReason());
        $item->setIcmsOperationValueMono(2.2);
        $this->assertSame(2.2, $item->getIcmsOperationValueMono());
        $item->setIcmsDeferredValueMono(2.2);
        $this->assertSame(2.2, $item->getIcmsDeferredValueMono());
        $item->setIcmsWithheldBaseCalculation(201);
        $this->assertSame(201, $item->getIcmsWithheldBaseCalculation());
        $item->setIcmsWithheldRate(2.2);
        $this->assertSame(2.2, $item->getIcmsWithheldRate());
        $item->setIcmsWithheldValueMono(2.2);
        $this->assertSame(2.2, $item->getIcmsWithheldValueMono());
        $item->setPisBaseCalc(2.2);
        $this->assertSame(2.2, $item->getPisBaseCalc());
        $item->setPisRate(2.2);
        $this->assertSame(2.2, $item->getPisRate());
        $item->setPisQuantity(2.2);
        $this->assertSame(2.2, $item->getPisQuantity());
        $item->setPisRateValue(2.2);
        $this->assertSame(2.2, $item->getPisRateValue());
        $item->setPisValue(2.2);
        $this->assertSame(2.2, $item->getPisValue());
        $item->setCofinsBaseCalc(2.2);
        $this->assertSame(2.2, $item->getCofinsBaseCalc());
        $item->setCofinsRate(2.2);
        $this->assertSame(2.2, $item->getCofinsRate());
        $item->setCofinsQuantity(2.2);
        $this->assertSame(2.2, $item->getCofinsQuantity());
        $item->setCofinsRateValue(2.2);
        $this->assertSame(2.2, $item->getCofinsRateValue());
        $item->setCofinsValue(2.2);
        $this->assertSame(2.2, $item->getCofinsValue());
        $item->setIpiCst(201);
        $this->assertSame(201, $item->getIpiCst());
        $item->setIpiBaseCalc(2.2);
        $this->assertSame(2.2, $item->getIpiBaseCalc());
        $item->setIpiQuantity(2.2);
        $this->assertSame(2.2, $item->getIpiQuantity());
        $item->setIpiValuePerTaxableUnit(2.2);
        $this->assertSame(2.2, $item->getIpiValuePerTaxableUnit());
        $item->setIpiProducerCnpj('ipiProducerCnpj_v2');
        $this->assertSame('ipiProducerCnpj_v2', $item->getIpiProducerCnpj());
        $item->setIpiControlSealCode('ipiControlSealCode_v2');
        $this->assertSame('ipiControlSealCode_v2', $item->getIpiControlSealCode());
        $item->setIpiControlSealQuantity(201);
        $this->assertSame(201, $item->getIpiControlSealQuantity());
        $item->setIpiClassificationClass(201);
        $this->assertSame(201, $item->getIpiClassificationClass());
        $item->setCest('cest_v2');
        $this->assertSame('cest_v2', $item->getCest());
        $item->setDiscount(2.2);
        $this->assertSame(2.2, $item->getDiscount());
        $item->setFreight(2.2);
        $this->assertSame(2.2, $item->getFreight());
        $item->setIsTaxSituation('isTaxSituation_v2');
        $this->assertSame('isTaxSituation_v2', $item->getIsTaxSituation());
        $item->setIsClassificationClass('isClassificationClass_v2');
        $this->assertSame('isClassificationClass_v2', $item->getIsClassificationClass());
        $item->setIsBaseCalc(2.2);
        $this->assertSame(2.2, $item->getIsBaseCalc());
        $item->setIsRate(2.2);
        $this->assertSame(2.2, $item->getIsRate());
        $item->setIsSpecificRate(2.2);
        $this->assertSame(2.2, $item->getIsSpecificRate());
        $item->setIsTaxableUnit('isTaxableUnit_v2');
        $this->assertSame('isTaxableUnit_v2', $item->getIsTaxableUnit());
        $item->setIsTaxableQuantity(2.2);
        $this->assertSame(2.2, $item->getIsTaxableQuantity());
        $item->setIsValue(2.2);
        $this->assertSame(2.2, $item->getIsValue());
        $item->setIbsCbsTaxSituationCode('ibsCbsTaxSituationCode_v2');
        $this->assertSame('ibsCbsTaxSituationCode_v2', $item->getIbsCbsTaxSituationCode());
        $item->setIbsCbsTaxClassificationCode('ibsCbsTaxClassificationCode_v2');
        $this->assertSame('ibsCbsTaxClassificationCode_v2', $item->getIbsCbsTaxClassificationCode());
        $item->setIbsCbsTaxBaseValue(2.2);
        $this->assertSame(2.2, $item->getIbsCbsTaxBaseValue());
        $item->setIbsUfRate(2.2);
        $this->assertSame(2.2, $item->getIbsUfRate());
        $item->setIbsUfDeferralPercentage(2.2);
        $this->assertSame(2.2, $item->getIbsUfDeferralPercentage());
        $item->setIbsUfDeferredValue(2.2);
        $this->assertSame(2.2, $item->getIbsUfDeferredValue());
        $item->setIbsUfReturnedTaxValue(2.2);
        $this->assertSame(2.2, $item->getIbsUfReturnedTaxValue());
        $item->setIbsUfRateReductionPercentage(2.2);
        $this->assertSame(2.2, $item->getIbsUfRateReductionPercentage());
        $item->setIbsUfEffectiveRate(2.2);
        $this->assertSame(2.2, $item->getIbsUfEffectiveRate());
        $item->setIbsUfTaxValue(2.2);
        $this->assertSame(2.2, $item->getIbsUfTaxValue());
        $item->setIbsMunicipalityRate(2.2);
        $this->assertSame(2.2, $item->getIbsMunicipalityRate());
        $item->setIbsMunicipalityDeferralPercentage(2.2);
        $this->assertSame(2.2, $item->getIbsMunicipalityDeferralPercentage());
        $item->setIbsMunicipalityDeferredValue(2.2);
        $this->assertSame(2.2, $item->getIbsMunicipalityDeferredValue());
        $item->setIbsMunicipalityReturnedTaxValue(2.2);
        $this->assertSame(2.2, $item->getIbsMunicipalityReturnedTaxValue());
        $item->setIbsMunicipalityRateReductionPercentage(2.2);
        $this->assertSame(2.2, $item->getIbsMunicipalityRateReductionPercentage());
        $item->setIbsMunicipalityEffectiveRate(2.2);
        $this->assertSame(2.2, $item->getIbsMunicipalityEffectiveRate());
        $item->setIbsMunicipalityTaxValue(2.2);
        $this->assertSame(2.2, $item->getIbsMunicipalityTaxValue());
        $item->setIbsTotalValue(2.2);
        $this->assertSame(2.2, $item->getIbsTotalValue());
        $item->setCbsRate(2.2);
        $this->assertSame(2.2, $item->getCbsRate());
        $item->setCbsDeferralPercentage(2.2);
        $this->assertSame(2.2, $item->getCbsDeferralPercentage());
        $item->setCbsDeferredValue(2.2);
        $this->assertSame(2.2, $item->getCbsDeferredValue());
        $item->setCbsReturnedTaxValue(2.2);
        $this->assertSame(2.2, $item->getCbsReturnedTaxValue());
        $item->setCbsRateReductionPercentage(2.2);
        $this->assertSame(2.2, $item->getCbsRateReductionPercentage());
        $item->setCbsEffectiveRate(2.2);
        $this->assertSame(2.2, $item->getCbsEffectiveRate());
        $item->setCbsValue(2.2);
        $this->assertSame(2.2, $item->getCbsValue());
        $item->setIbsCbsRegularTaxSituationCode('ibsCbsRegularTaxSituationCode_v2');
        $this->assertSame('ibsCbsRegularTaxSituationCode_v2', $item->getIbsCbsRegularTaxSituationCode());
        $item->setIbsCbsRegularTaxClassificationCode('ibsCbsRegularTaxClassificationCode_v2');
        $this->assertSame('ibsCbsRegularTaxClassificationCode_v2', $item->getIbsCbsRegularTaxClassificationCode());
        $item->setIbsUfRegularEffectiveRate(2.2);
        $this->assertSame(2.2, $item->getIbsUfRegularEffectiveRate());
        $item->setIbsUfRegularTaxValue(2.2);
        $this->assertSame(2.2, $item->getIbsUfRegularTaxValue());
        $item->setIbsMunicipalityRegularEffectiveRate(2.2);
        $this->assertSame(2.2, $item->getIbsMunicipalityRegularEffectiveRate());
        $item->setIbsMunicipalityRegularTaxValue(2.2);
        $this->assertSame(2.2, $item->getIbsMunicipalityRegularTaxValue());
        $item->setCbsRegularEffectiveRate(2.2);
        $this->assertSame(2.2, $item->getCbsRegularEffectiveRate());
        $item->setCbsRegularTaxValue(2.2);
        $this->assertSame(2.2, $item->getCbsRegularTaxValue());
        $item->setPresumedCreditClassificationCode(201);
        $this->assertSame(201, $item->getPresumedCreditClassificationCode());
        $item->setIbsPresumedCreditPercentage(2.2);
        $this->assertSame(2.2, $item->getIbsPresumedCreditPercentage());
        $item->setIbsPresumedCreditValue(2.2);
        $this->assertSame(2.2, $item->getIbsPresumedCreditValue());
        $item->setIbsPresumedCreditSuspensiveConditionValue(2.2);
        $this->assertSame(2.2, $item->getIbsPresumedCreditSuspensiveConditionValue());
        $item->setCbsPresumedCreditPercentage(2.2);
        $this->assertSame(2.2, $item->getCbsPresumedCreditPercentage());
        $item->setCbsPresumedCreditValue(2.2);
        $this->assertSame(2.2, $item->getCbsPresumedCreditValue());
        $item->setCbsPresumedCreditSuspensiveConditionValue(2.2);
        $this->assertSame(2.2, $item->getCbsPresumedCreditSuspensiveConditionValue());
        $item->setPresumedCreditZfmCompetence('presumedCreditZfmCompetence_v2');
        $this->assertSame('presumedCreditZfmCompetence_v2', $item->getPresumedCreditZfmCompetence());
        $item->setPresumedCreditZfmClassification('presumedCreditZfmClassification_v2');
        $this->assertSame('presumedCreditZfmClassification_v2', $item->getPresumedCreditZfmClassification());
        $item->setPresumedCreditZfmValue(2.2);
        $this->assertSame(2.2, $item->getPresumedCreditZfmValue());
        $item->setMonoTaxedQuantityBase(2.2);
        $this->assertSame(2.2, $item->getMonoTaxedQuantityBase());
        $item->setMonoIbsAdRemRate(2.2);
        $this->assertSame(2.2, $item->getMonoIbsAdRemRate());
        $item->setMonoCbsAdRemRate(2.2);
        $this->assertSame(2.2, $item->getMonoCbsAdRemRate());
        $item->setMonoIbsValue(2.2);
        $this->assertSame(2.2, $item->getMonoIbsValue());
        $item->setMonoCbsValue(2.2);
        $this->assertSame(2.2, $item->getMonoCbsValue());
        $item->setMonoRetainedTaxedQuantityBase(2.2);
        $this->assertSame(2.2, $item->getMonoRetainedTaxedQuantityBase());
        $item->setMonoIbsRetentionRate(2.2);
        $this->assertSame(2.2, $item->getMonoIbsRetentionRate());
        $item->setMonoIbsRetentionValue(2.2);
        $this->assertSame(2.2, $item->getMonoIbsRetentionValue());
        $item->setMonoCbsRetentionRate(2.2);
        $this->assertSame(2.2, $item->getMonoCbsRetentionRate());
        $item->setMonoCbsRetentionValue(2.2);
        $this->assertSame(2.2, $item->getMonoCbsRetentionValue());
        $item->setMonoPreviouslyRetainedQuantityBase(2.2);
        $this->assertSame(2.2, $item->getMonoPreviouslyRetainedQuantityBase());
        $item->setMonoIbsPreviouslyRetainedRate(2.2);
        $this->assertSame(2.2, $item->getMonoIbsPreviouslyRetainedRate());
        $item->setMonoIbsPreviouslyRetainedValue(2.2);
        $this->assertSame(2.2, $item->getMonoIbsPreviouslyRetainedValue());
        $item->setMonoCbsPreviouslyRetainedRate(2.2);
        $this->assertSame(2.2, $item->getMonoCbsPreviouslyRetainedRate());
        $item->setMonoCbsPreviouslyRetainedValue(2.2);
        $this->assertSame(2.2, $item->getMonoCbsPreviouslyRetainedValue());
        $item->setMonoIbsDeferredPercentage(2.2);
        $this->assertSame(2.2, $item->getMonoIbsDeferredPercentage());
        $item->setMonoIbsDeferredValue(2.2);
        $this->assertSame(2.2, $item->getMonoIbsDeferredValue());
        $item->setMonoCbsDeferredPercentage(2.2);
        $this->assertSame(2.2, $item->getMonoCbsDeferredPercentage());
        $item->setMonoCbsDeferredValue(2.2);
        $this->assertSame(2.2, $item->getMonoCbsDeferredValue());
        $item->setMonoIbsTotalItem(2.2);
        $this->assertSame(2.2, $item->getMonoIbsTotalItem());
        $item->setMonoCbsTotalItem(2.2);
        $this->assertSame(2.2, $item->getMonoCbsTotalItem());
        $item->setIbsTransferredValue(2.2);
        $this->assertSame(2.2, $item->getIbsTransferredValue());
        $item->setCbsTransferredValue(2.2);
        $this->assertSame(2.2, $item->getCbsTransferredValue());
        $item->setAssessmentCompetenceDate('assessmentCompetenceDate_v2');
        $this->assertSame('assessmentCompetenceDate_v2', $item->getAssessmentCompetenceDate());
        $item->setIbsCompetenceAdjustmentAmount(2.2);
        $this->assertSame(2.2, $item->getIbsCompetenceAdjustmentAmount());
        $item->setCbsCompetenceAdjustmentAmount(2.2);
        $this->assertSame(2.2, $item->getCbsCompetenceAdjustmentAmount());
        $item->setFuelAnpCode('fuelAnpCode_v2');
        $this->assertSame('fuelAnpCode_v2', $item->getFuelAnpCode());
        $item->setFuelAnpDescription('fuelAnpDescription_v2');
        $this->assertSame('fuelAnpDescription_v2', $item->getFuelAnpDescription());
        $item->setFuelUf('fuelUf_v2');
        $this->assertSame('fuelUf_v2', $item->getFuelUf());
        $item->setTaxBenefitCode('taxBenefitCode_v2');
        $this->assertSame('taxBenefitCode_v2', $item->getTaxBenefitCode());
    }

    public function testOriginAcceptsEnumInstanceInConstructor(): void
    {
        $origin = OriginEnum::ESTRANGEIRA_IMPORTACAO_DIRETA_EXCETO_6();
        $item   = new InvoiceItem(origin: $origin);

        $this->assertSame($origin, $item->getOrigin());
    }

    public function testOriginNullByDefault(): void
    {
        $item = new InvoiceItem();

        $this->assertNull($item->getOrigin());
    }
}
